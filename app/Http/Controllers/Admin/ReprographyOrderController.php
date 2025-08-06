<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReprographyOrder;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderAcceptedNotification;
use App\Notifications\OrderRejectedNotification;
use App\Notifications\OrderCompletedNotification;
use App\Notifications\OrderCancelledNotification;



class ReprographyOrderController extends Controller
{
    //
       public function index(){
        return view('admin.layouts.reprography.reprography');
    }

    public function datatable(Request $request){
       $requests =ReprographyOrder::with('user.client')->select('reprography_orders.*');
       return DataTables::of($requests)
       ->addColumn('client', function ($request) {
           $client = $request->user?->client;
           return $client
               ? $client->fist_name . ' ' . $client->last_name
               : 'Non renseigné';
       })
       ->addColumn('details', function ($request) {
           return route('reprography.details', $request->id);
       })
       ->rawColumns(['client'])
       ->toJson();
    }

     public function details($id)
        {
            $order = ReprographyOrder::with('user.client')->findOrFail($id);
            return view('admin.layouts.reprography.reprography-details', compact('order'));
           
        }

        public function download($id)
        {
                  //  $filePath = $request->file('file')->store('reprography/files', 'public');

            $order = ReprographyOrder::with('user.client')->findOrFail($id);
        return Storage::disk('public')->download($order->file_path );
        }


         public function acceptOrder(Request $request, $id)
    {
        DB::beginTransaction();
        
        try {
            $order = ReprographyOrder::findOrFail($id);
            
            // Vérifier que la commande est bien en attente
            if ($order->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Seules les commandes en attente peuvent être acceptées'
                ], 400);
            }
            
            // Mettre à jour le statut
            $order->update([
                'status' => 'processing',
                'updated_at' => now(),
            ]);
            
            // Envoyer une notification au client
            $order->user->notify(new OrderAcceptedNotification($order));
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Commande acceptée avec succès',
                'data' => $order
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'acceptation de la commande',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Rejeter une commande de reprographie
     */
    public function rejectOrder(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);
        
        DB::beginTransaction();
        
        try {
            $order = ReprographyOrder::findOrFail($id);
            
            // Vérifier que la commande est bien en attente
            if ($order->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Seules les commandes en attente peuvent être rejetées'
                ], 400);
            }
            
            // Mettre à jour le statut
            $order->update([
                'status' => 'rejected',
                'updated_at' => now(),
            ]);
            
            // Envoyer une notification au client
            $order->client->notify(new OrderRejectedNotification($order, $request->reason));
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Commande rejetée avec succès',
                'data' => $order
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du rejet de la commande',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Marquer une commande comme terminée
     */
    public function completeOrder(Request $request, $id)
    {
        DB::beginTransaction();
        
        try {
            $order = ReprographyOrder::findOrFail($id);
            
            // Vérifier que la commande est bien en traitement
            if ($order->status !== 'processing') {
                return response()->json([
                    'success' => false,
                    'message' => 'Seules les commandes en traitement peuvent être marquées comme terminées'
                ], 400);
            }
            
            // Mettre à jour le statut
            $order->update([
                'status' => 'completed',
                'updated_at' => now(),
            ]);
            
            // Envoyer une notification au client
            $order->user->notify(new OrderCompletedNotification($order));
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Commande marquée comme terminée avec succès',
                'data' => $order
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du statut',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Annuler une commande
     */
    public function cancelOrder(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);
        
        DB::beginTransaction();
        
        try {
            $order = ReprographyOrder::findOrFail($id);
            
            // Vérifier que la commande peut être annulée
            if (!in_array($order->status, ['pending', 'processing'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Seules les commandes en attente ou en traitement peuvent être annulées'
                ], 400);
            }
            
            // Mettre à jour le statut
            $order->update([
                'status' => 'cancelled',
                'updated_at' => now(),
            ]);
            
            // Envoyer une notification au client
            $order->user->notify(new OrderCancelledNotification($order, $request->reason));
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Commande annulée avec succès',
                'data' => $order
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'annulation de la commande',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
