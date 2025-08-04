@extends('admin.master')
@section('extra-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="{{asset('stdev/css/badge-status.css')}}">
   
@endsection



@section('page-content')

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Documents Partagés</h4>
    </div>
    <div class="card-body">
        <form method="POST"  id="infoForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Titre*</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Type*</label>
                        <select name="type" class="form-control" id="doc-type">
                            <option value="file">Fichier</option>
                            <option value="link">Lien</option>
                            <option value="info">Information</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="doc-file">
                        <label>Fichier*</label>
                        <input type="file" name="file" class="form-control-file">
                    </div>
                    
                    <div class="form-group d-none" id="doc-link">
                        <label>URL*</label>
                        <input type="url" name="link" class="form-control" placeholder="https://">
                    </div>
                    
                    <div class="form-group d-none" id="doc-info">
                        <label>Contenu*</label>
                        <textarea name="content" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Visibilité*</label>
                        <select name="visibility" class="form-control" id="visibility">
                            <option value="global">Tous les utilisateurs</option>
                            <option value="specific">Utilisateur spécifique</option>
                        </select>
                    </div>
                    
                    <div class="form-group d-none" id="user-field">
                        <label>Rechercher un utilisateur*</label>
                        <input type="text" class="form-control" placeholder="Nom d'utilisateur" id="user-search" name="user">
                        <select name="user_id" class="form-control user-select" id="user-select">
                            <!-- Chargé via AJAX -->
                        </select>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Partager</button>
        </form>
        
        <hr>
        
        <h5 class="mt-4">Documents Existants</h5>
        <table class="table table-striped">
            <!-- Liste des documents -->
        </table>
    </div>
</div>
@endsection 

@section('extra-scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Gestion de l'affichage dynamique
    document.getElementById('doc-type').addEventListener('change', function() {
        ['file', 'link', 'info'].forEach(type => {
            const el = document.getElementById(`doc-${type}`);
            if (el) el.classList.toggle('d-none', type !== this.value);
        });
    });

    document.getElementById('visibility').addEventListener('change', function() {
        document.getElementById('user-field').classList.toggle('d-none', this.value !== 'specific');
    });

    // Recherche d'utilisateurs

    document.querySelector('#user-search').addEventListener('input', function() {
    const query = this.value.trim();
    const select = document.querySelector('#user-select');
    
    // Vider le select avant nouvelle recherche
    select.innerHTML = '';
    
    if (query.length < 2) return; // Ne pas chercher pour moins de 2 caractères

    const params = new URLSearchParams({ query: query });

    fetch(`/admin/users/search?${params.toString()}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau');
        }
        return response.json();
    })
    .then(data => {
        if (data.length === 0) {
            const option = new Option('Aucun résultat trouvé', '');
            select.add(option);
        } else {
            data.forEach(user => {
                // Correction du typo: fist_name → first_name
                const option = new Option(`${user.fist_name} ${user.last_name}`, user.id);
                select.add(option);
            });
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        const option = new Option('Erreur de chargement', '');
        select.add(option);
    });
});


document.getElementById('infoForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    
    try {
        const response = await fetch('{{ route('messages.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();
        
        if (!response.ok) throw data;

        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Message envoyé',
                showConfirmButton: false,
                timer: 2500
            });
            
            setTimeout(() => window.location.href = '/admin/messages', 1500);
        }
    } catch (error) {
        let errorMessage = 'Une erreur est survenue';
        
        if (error.errors) {
            errorMessage = Object.values(error.errors).join('<br>');
        } else if (error.message) {
            errorMessage = error.message;
        }
        
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            html: errorMessage,
            showConfirmButton: true
        });
    }
});
</script>

@endsection