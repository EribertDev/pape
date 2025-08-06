<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReprographyOrder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use App\Models\Client;

class ReprographyOrderController extends Controller
{
    //

     public function create()
    {
        $hasPreviousOrder = Commande::where('client_id',session('client_id'));
        return view('clients.layouts.reprography.create',compact('hasPreviousOrder'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contact' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'service_types' => 'required|array',
            'color' => 'nullable|string|max:50',
            'option' => 'required|in:Recto seul,Recto verso',
            'format' => 'required|in:A4,A3,A2',
            'binding' => 'boolean',
            'binding_type' => 'nullable|required_if:binding,true|in:Anneaux,Sérodo,thermique en livre',
            'lamination' => 'boolean',
            'page_count' => 'required|integer|min:1',
            'copy_count' => 'required|integer|min:1',
            'delivery_mode' => 'required|in:Domicile,Point relais',
            'commune' => 'nullable|required_if:delivery_mode,Domicile|string|max:100',
            'neighborhood' => 'nullable|required_if:delivery_mode,Domicile|string|max:100',
            'address_details' => 'nullable|required_if:delivery_mode,Domicile|string|max:255',
            'gps_location' => 'nullable|string|max:255',
            'relay_point' => 'nullable|required_if:delivery_mode,Point relais|string|max:255',
            'student_tariff' => 'boolean',
        ]);

        // Calcul des coûts
        $costPerPage = $request->student_tariff ? 50 : 100; // Exemple en FCFA
        $orderCost = $validated['page_count'] * $validated['copy_count'] * $costPerPage;
        $deliveryCost = $request->delivery_mode === 'Domicile' ? 1000 : 500; // Exemple en FCFA
        $totalCost = $orderCost + $deliveryCost;

        // Stockage du fichier
        $filePath = $request->file('file')->store('reprography/files', 'public');

        $order = ReprographyOrder::create([
            'user_id' => Auth::id(),
            'contact' => $validated['contact'],
            'file_path' => $filePath,
            'service_types' => $validated['service_types'],
            'color' => $validated['color'] ?? null,
            'option' => $validated['option'],
            'format' => $validated['format'],
            'binding' => $validated['binding'] ?? false,
            'binding_type' => $validated['binding'] ? $validated['binding_type'] : null,
            'lamination' => $validated['lamination'] ?? false,
            'page_count' => $validated['page_count'],
            'copy_count' => $validated['copy_count'],
            'delivery_mode' => $validated['delivery_mode'],
            'commune' => $validated['commune'] ?? null,
            'neighborhood' => $validated['neighborhood'] ?? null,
            'address_details' => $validated['address_details'] ?? null,
            'gps_location' => $validated['gps_location'] ?? null,
            'relay_point' => $validated['relay_point'] ?? null,
            'student_tariff' => $validated['student_tariff'] ?? false,
            'order_cost' => $orderCost,
            'delivery_cost' => $deliveryCost,
            'total_cost' => $totalCost,
        ]);

        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'message' => 'Votre commande de reprographie a été enregistrée avec succès!'
        ]);
    }
}
