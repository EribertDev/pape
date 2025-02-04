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
            $clientsTotal = (new Client())->count();
            $paymentTotal = (new Payement())->where('status_id', Status::getIdByName('Payer'))->sum('amount');
            $commandeTotal = (new Commande())->count();
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
                'clientsTotal'=> $clientsTotal,
                'payementTotal'=> $paymentTotal,
                'commandeTotal'=> $commandeTotal,
                'commandeTraiterTotal'=> $commandeTraiterTotal,
            ];
        }

        // Retourner la vue avec les données
        return view('admin.layouts.dash',  compact('labels', 'orderData', 'revenueData',))->with("data",$data);
    }

}
