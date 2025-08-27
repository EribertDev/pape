@extends('admin.master')
@section('title', 'Gestion des visioconférences')

@section('page-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-video"></i> Gestion des visioconférences
                    </h3>
                </div>
                <div class="card-body">
                    @if($videoCalls->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Commande</th>
                                    <th>Créée par</th>
                                    <th>Salon</th>
                                    <th>Début</th>
                                    <th>Statut</th>
                                    <th>Participants</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($videoCalls as $videoCall)
                                <tr>
                                    <td>{{ $videoCall->id }}</td>
                                    <td>
                                        <a href="{{ route('commandes.show', $videoCall->commande_id) }}">
                                            Commande #{{ $videoCall->commande_id }}
                                        </a>
                                    </td>
                                    <td>{{ $videoCall->creator->name }}</td>
                                    <td>{{ $videoCall->room_name }}</td>
                                    <td>{{ $videoCall->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($videoCall->isCurrentlyActive())
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Terminée</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $videoCall->participants ? count($videoCall->participants) : 0 }}
                                    </td>
                                    <td>
                                        <a href="{{ route('video-call.join', $videoCall->id) }}" 
                                           class="btn btn-sm btn-primary" target="_blank">
                                            <i class="fas fa-phone"></i> Rejoindre
                                        </a>
                                        <a href="{{ route('admin.video-calls.show', $videoCall->id) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Détails
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $videoCalls->links() }}
                    </div>
                    @else
                    <div class="alert alert-info">
                        Aucune visioconférence n'a été créée pour le moment.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection