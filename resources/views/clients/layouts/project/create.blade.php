@extends('clients.master-1')
@section('extra-style')
<link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}">
    <script  src="{{asset('client/js-simple-loader-main/loader.js')}}"  ></script>

    <style>
    .card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .form-label {
        color: #495057;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .btn-lg {
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7, #0a58ca);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
    
    textarea {
        min-height: 120px;
        resize: vertical;
    }
</style>
@endsection 

@section('page-content')
    
    <div class="container py-5 " style="margin-top: 150px">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg">
                <div class="card-header text-white py-4" style="background-color: #2eca7f">
                    <h2 class="mb-0 text-center">Demande d'Assistance pour la Rédaction de Projet/Business Plan</h2>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('project_request.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Titre du projet</label>
                            <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="problem" class="form-label fw-bold">Problème à résoudre</label>
                            <textarea class="form-control @error('problem') is-invalid @enderror" id="problem" name="problem" rows="3" required>{{ old('problem') }}</textarea>
                            @error('problem')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="general_objective" class="form-label fw-bold">Objectif général</label>
                            <textarea class="form-control @error('general_objective') is-invalid @enderror" id="general_objective" name="general_objective" rows="3" required>{{ old('general_objective') }}</textarea>
                            @error('general_objective')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="specific_objectives" class="form-label fw-bold">Objectifs spécifiques</label>
                            <textarea class="form-control @error('specific_objectives') is-invalid @enderror" id="specific_objectives" name="specific_objectives" rows="3" required>{{ old('specific_objectives') }}</textarea>
                            @error('specific_objectives')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="beneficiaries" class="form-label fw-bold">Bénéficiaires</label>
                            <textarea class="form-control @error('beneficiaries') is-invalid @enderror" id="beneficiaries" name="beneficiaries" rows="3" required>{{ old('beneficiaries') }}</textarea>
                            @error('beneficiaries')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="partners" class="form-label fw-bold">Partenaires</label>
                            <textarea class="form-control @error('partners') is-invalid @enderror" id="partners" name="partners" rows="3" required>{{ old('partners') }}</textarea>
                            @error('partners')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="budget" class="form-label fw-bold">Budget disponible (F CFA)</label>
                            <input type="number" class="form-control form-control-lg @error('budget') is-invalid @enderror" id="budget" name="budget" value="{{ old('budget') }}" required min="0">
                            @error('budget')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="document" class="form-label fw-bold">Document du projet (PDF, Word)</label>
                            <input class="form-control @error('document') is-invalid @enderror" type="file" id="document" name="document" accept=".pdf,.doc,.docx" required>
                            @error('document')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Taille maximale: 2MB | Formats acceptés: PDF, DOC, DOCX</small>
                        </div>

                        <div class="alert alert-info">
                            <h5 class="mb-2"><i class="bi bi-info-circle"></i> Informations importantes</h5>
                            <ul class="mb-0">
                                <li>Le montant standard pour chaque projet est de <strong>100 000 F CFA</strong></li>
                                <li>Nous traiterons votre demande dans les 48 heures</li>
                                <li>Un expert vous contactera pour discuter des détails</li>
                            </ul>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-lg py-3 fw-bold" style="background-color: #2eca7f">Soumettre la demande</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('extra-scripts')

@endsection