<?php

namespace App\Exports;

use App\Models\Commande;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Collection;
use App\Http\Controllers\Admin\DashController;

class FastExcelStatistiquesExport
{
    protected $startDate;
    protected $endDate;
    
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
 
    public function export()
{
    // 1. Récupérer les données
    $stats = app(DashController::class)->getStats($this->startDate, $this->endDate);
    $commandes = Commande::with('client')
        ->whereBetween('created_at', [$this->startDate, $this->endDate])
        ->get();

    // 2. Construire le contenu unifié
    $contenuUnifie = collect([
        // Titre principal
        ['STATISTIQUES PAPE du ' . $this->startDate . ' au ' . $this->endDate],
        [], 
        [],
        [],
        // En-têtes Statistiques
        ['INDICATEUR', 'VALEUR'],
        
        // Données Statistiques
        ['Total Clients', $stats['total_clients']],
        ['Revenu Total', number_format($stats['revenu_total'], 2) . ' FCFA'],
        ['Travaux VIP en attente', $stats['vip_en_attente']],
        ['Travaux Standard en attente', $stats['standard_en_attente']],
        ['Travaux achevés', $stats['travaux_acheves']],
        
        [], // Ligne vide de séparation
        
        // Titre Section Commandes
        ['LISTE DES COMMANDES'],
        [], // Ligne vide

        // En-têtes Commandes
        ['N° Commande', 'Client', 'Type', 'Statut', 'Montant', 'Date Commande', 'Delai de livraison'],
        
        // Données Commandes
        ...$commandes->map(function ($commande) {
            return [
                $commande->client->phone_number,
                $commande->client->fist_name . ' ' . $commande->client->last_name,
                ucfirst($commande->structure_stage ?? 'Inconnu'),
                str_replace('_', ' ', $commande->status->name),
                number_format($commande->amount, 2) . ' FCFA',
                $commande->created_at->format('d/m/Y'),
                 'Delai de livraison' => $commande->deadline,
                
            ];
        })->toArray()
    ]);

    // 3. Export avec mise en forme
    return (new FastExcel($contenuUnifie))
        ->sheet('Rapport Consolidé', function ($sheet) {
            // Fusionner la cellule du titre
            $sheet->mergeCells('A1:B1');
            
            // Style du titre principal
            $sheet->cell('A1', function ($cell) {
                $cell->setFont(['bold' => true, 'size' => 14])
                     ->setAlignment('center');
            });
            
            // Style des sous-titres
            $sheet->cell('A8', function ($cell) {
                $cell->setFont(['bold' => true]);
            });
            
            // Auto-ajustement des colonnes
            $sheet->setAutoSize(true);
        })
            ->download('Statistiques_pape_'.$this->startDate.'_'.$this->endDate.'.xlsx');
}
}