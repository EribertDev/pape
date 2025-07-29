<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Status;
use App\Models\Commande;
use App\Models\Payement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Cache\ArrayStore;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Exports\StatistiquesExport;
use App\Exports\FastExcelStatistiquesExport;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Stage;


class DashController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        $data=[];

       if (Role::getNameById(Auth::user()->roles_id) == "Affilier") {
            $code_af = (new Admin())->where('user_id', Auth::user()->id)->first()->code_af;
            if ($code_af !== null) {
                $afTotalMonth = (new Commande())->getTotalCommandeByAffiliateCodeForMonth($code_af, date('m'), date('Y'));
                $monthGain = 1500 * $afTotalMonth;
               // dd($afTotalMonth);

                $data = [
                        'code_af' => $code_af,
                        'afTotalMonth' => $afTotalMonth,
                        'monthGain' => $monthGain
                ];
            }
        }else{



    // Dates par défaut (année en cours)
        $startDate = $request->input('start_date', Carbon::now()->startOfYear()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfYear()->format('Y-m-d'));
        
        // Récupération des données
        $stats = $this->getStats($startDate, $endDate);
        $years = Commande::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        




            
            $clientsTotal = (new Client())->count();
            $paymentTotal = (new Payement())->where('status_id', Status::getIdByName('Payer'))->sum('amount');
            $vip_attente = (new Commande())->where('structure_stage', 'vip')->where('status_id', Status::getIdByName('En attente'))->count();
            $standard_attente = (new Commande())->where('structure_stage', 'standard',)->where('status_id', Status::getIdByName('En attente'))->count();
            $commandeTotal = (new Commande())->count();
            $commandeTaiter= (new Commande())->where('status_id', Status::getIdByName('Traiter'))->count();
            $commandeTraiterTotal = (new Commande())->where('status_id', Status::getIdByName('Traiter'))->count();
            $endDate = Carbon::now();
            $startDate = Carbon::now()->subMonths(9);
        
            // Récupérer les commandes groupées par mois
            $orders = Commande::whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')
                ->groupBy('year', 'month')
                ->get();
            
                // Récupérer les revenus
            $revenues = Payement::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('SUM(amount) as total, YEAR(created_at) year, MONTH(created_at) month')
            ->groupBy('year', 'month')
            ->where('status_id', Status::getIdByName('Payer'))
            ->get();
            $labels = [];
            $orderData = [];
            $revenueData = [];
        
            for ($i = 9; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $monthKey = $date->format('Y-m');
                
                $labels[] = $date->translatedFormat('M Y');
                
                // Trouver les données correspondantes
                $order = $orders->firstWhere('month', $date->month);
                $orderData[] = $order ? $order->count : 0;
        
                $revenue = $revenues->firstWhere('month', $date->month);
                $revenueData[] = $revenue ? $revenue->total : 0;
            }
           
            $data = [
                'stages_pending' => Stage::where('status', 'pending')->count(),
                'stages_approved' => Stage::where('status', 'approved')->count(),
                'stages_under_review' => Stage::where('status', 'under_review')->count(),
                'clientsTotal'=> $clientsTotal,
                'payementTotal'=> $paymentTotal,
                'commandeTotal'=> $commandeTotal,
                'commandeTraiterTotal'=> $commandeTraiterTotal,
                'vip_attente'=> $vip_attente,
                'standard_attente'=> $standard_attente,
                'commandeTaiter'=> $commandeTaiter,
            ];
        }

        // Retourner la vue avec les données
        return view('admin.layouts.dash',  compact('labels', 'orderData', 'revenueData','years','stats','startDate', 'endDate'))->with("data",$data);
    }

     public function getStats($startDate, $endDate)
    {
        return [
            'total_clients' => Commande::whereBetween('created_at', [$startDate, $endDate])
                ->distinct('client_id')
                ->count('client_id'),
                
            'revenu_total' => Payement::whereBetween('created_at', [$startDate, $endDate])
                ->where('status_id', Status::getIdByName('Payer'))
                ->sum('amount'),
                
            'vip_en_attente' => Commande::where('structure_stage', 'vip')
                ->where('status_id', Status::getIdByName('En attente'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
                
            'standard_en_attente' => Commande::where('structure_stage', 'standard')
                ->where('status_id', Status::getIdByName('En attente'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
                
            'travaux_acheves' => Commande::where('status_id', Status::getIdByName('Traiter'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
                
            'evolution_mensuelle' => $this->getMonthlyStats($startDate, $endDate),
                
            'repartition_type' => Commande::selectRaw('structure_stage, count(*) as count')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('structure_stage')
                ->pluck('count', 'structure_stage'),
                
            'repartition_statut' => Commande::selectRaw('status_id, count(*) as count')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('status_id')
                ->pluck('count', 'status_id')
        ];
    }


     public function getMonthlyStats($startDate, $endDate)
    {
        return Commande::selectRaw('
                YEAR(created_at) as year, 
                MONTH(created_at) as month, 
                COUNT(*) as total,
                SUM(CASE WHEN status_id = "6" THEN 1 ELSE 0 END) as termines
            ')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    }


    public function export(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    
    return (new FastExcelStatistiquesExport($startDate, $endDate))->export();
}

}
