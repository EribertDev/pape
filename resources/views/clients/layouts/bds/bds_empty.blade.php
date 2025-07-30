<div class="col-12">
    <div class="text-center py-5 my-5">
        <div class="empty-state-icon">
            <i class="bi bi-database" style="font-size: 5rem; color: #6c757d;"></i>
        </div>
        <h3 class="mt-4 fw-bold" style="color: #495057;">Aucune base de données trouvée</h3>
        <p class="text-muted mt-3 mb-4" style="max-width: 500px; margin: 0 auto;">
            Aucun résultat ne correspond à vos critères de filtrage.
            <br>Essayez d'élargir votre plage de prix ou modifiez vos filtres.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-outline-primary reset-filter" style="border-radius: 25px;">
                <i class="bi bi-arrow-counterclockwise me-2"></i> Réinitialiser les filtres
            </button>
            <a href="{{ route('bds.all') }}" class="btn btn-primary" style="border-radius: 25px;">
                <i class="bi bi-list-ul me-2"></i> Voir toutes les bases
            </a>
        </div>
    </div>
</div>

<script>
    // Script pour gérer la réinitialisation des filtres
    document.querySelectorAll('.reset-filter').forEach(button => {
        button.addEventListener('click', function() {
            // Réinitialiser les champs de formulaire
            document.querySelectorAll('#priceFilterForm input').forEach(input => {
                input.value = '';
            });
            
            // Soumettre le formulaire pour rafraîchir les résultats
            document.getElementById('priceFilterForm').dispatchEvent(new Event('submit'));
        });
    });
</script>