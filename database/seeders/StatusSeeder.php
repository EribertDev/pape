<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            // Statuts généraux
            ['name' => 'Actif', 'description' => 'Indique que l\'élément est actuellement en cours d\'utilisation ou disponible.'],
            ['name' => 'Inactif', 'description' => 'Indique que l\'élément n\'est pas actuellement utilisé ou disponible.'],
            ['name' => 'En attente', 'description' => 'Indique que l\'élément est en attente de traitement ou d\'approbation.'],
            ['name' => 'Approuvé', 'description' => 'Indique que l\'élément a été approuvé pour utilisation ou traitement.'],
            ['name' => 'Rejeté', 'description' => 'Indique que l\'élément a été rejeté et ne doit pas être utilisé ou traité.'],
            ['name' => 'Traiter', 'description' => 'Indique que l\'élément est en cours de traitement.'], // Nouveau statut ajouté
            ['name' => 'En cours', 'description' => 'Indique que l\'élément est en cours de traitement ou d\'exécution.'],
            ['name' => 'Terminé', 'description' => 'Indique que le traitement ou l\'exécution de l\'élément est terminé.'],
            ['name' => 'En pause', 'description' => 'Indique que le traitement ou l\'exécution de l\'élément est temporairement suspendu.'],
            ['name' => 'À venir', 'description' => 'Indique que l\'élément sera disponible dans le futur mais n\'est pas encore actif.'],
            ['name' => 'Expiré', 'description' => 'Indique que l\'élément n\'est plus valide ou disponible.'],
            ['name' => 'Supprimé', 'description' => 'Indique que l\'élément a été supprimé de la base de données.'],
            ['name' => 'Archivé', 'description' => 'Indique que l\'élément a été archivé et n\'est plus actif mais peut être consulté pour référence.'],
        
            // Statuts de commande
            ['name' => 'En traitement', 'description' => 'Indique que la commande est en cours de traitement.'],
            ['name' => 'Expédié', 'description' => 'Indique que la commande a été expédiée.'],
            ['name' => 'Livré', 'description' => 'Indique que la commande a été livrée au client.'],
            ['name' => 'Annulé', 'description' => 'Indique que la commande a été annulée.'],
            ['name' => 'Remboursé', 'description' => 'Indique que la commande a été remboursée.'],
            ['name' => 'Retourné', 'description' => 'Indique que la commande a été retournée par le client.'],
        
            // Statuts de paiement
            ['name' => 'Payer', 'description' => 'Indique que le paiement a été reçu avec succès.'],
            ['name' => 'En attente de paiement', 'description' => 'Indique que le paiement n\'a pas encore été effectué.'],
            ['name' => 'Paiement reçu', 'description' => 'Indique que le paiement a été reçu avec succès.'],
            ['name' => 'Paiement en cours', 'description' => 'Indique que le paiement est en cours de traitement.'],
            ['name' => 'Échec du paiement', 'description' => 'Indique que le paiement a échoué.'],
            ['name' => 'Remboursement initié', 'description' => 'Indique qu\'un remboursement a été initié pour ce paiement.'],
            ['name' => 'Remboursement terminé', 'description' => 'Indique que le remboursement a été effectué avec succès.'],
        ];
        


        DB::table('statuses')->insert($statuses);
    }
}
