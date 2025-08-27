@extends('admin.master')
@section('extra-style')

@section('title', 'Détails de la visioconférence #' . $videoCall->id)

@section('page-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-video"></i> Détails de la visioconférence
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Informations générales</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID:</th>
                                    <td>{{ $videoCall->id }}</td>
                                </tr>
                                <tr>
                                    <th>Commande:</th>
                                    <td>
                                        <a href="{{ route('commandes.show', $videoCall->commande_id) }}">
                                            Commande #{{ $videoCall->commande_id }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Créée par:</th>
                                    <td>{{ $videoCall->creator->name }}</td>
                                </tr>
                                <tr>
                                    <th>Salon:</th>
                                    <td>{{ $videoCall->room_name }}</td>
                                </tr>
                                <tr>
                                    <th>Début:</th>
                                    <td>{{ $videoCall->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Statut:</th>
                                    <td>
                                        @if($videoCall->isCurrentlyActive())
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Terminée</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Accès à la visioconférence</h4>
                            <div class="mb-3">
                                <label>Lien de participation:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" 
                                           value="{{ $videoCall->join_url }}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" 
                                                onclick="copyToClipboard('{{ $videoCall->join_url }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Lien direct Jitsi:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" 
                                           value="{{ $videoCall->meeting_url }}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" 
                                                onclick="copyToClipboard('{{ $videoCall->meeting_url }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('video-call.join', $videoCall->id) }}" 
                                   class="btn btn-primary btn-lg" target="_blank">
                                    <i class="fas fa-phone"></i> Rejoindre la visioconférence
                                </a>
                            </div>
                        </div>
                    </div>

                    @if($videoCall->participants && count($videoCall->participants) > 0)
                    <div class="mt-4">
                        <h4>Participants</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Rejoint à</th>
                                    <th>Quitté à</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($videoCall->participants as $participant)
                                <tr>
                                    <td>{{ $participant['name'] }}</td>
                                    <td>{{ $participant['joined_at'] }}</td>
                                    <td>{{ $participant['left_at'] ?? 'En cours...' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Lien copié dans le presse-papier!');
    }, function(err) {
        console.error('Erreur lors de la copie: ', err);
    });
}
</script>
@endsection