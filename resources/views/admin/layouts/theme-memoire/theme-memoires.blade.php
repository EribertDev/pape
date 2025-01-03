@extends('admin.master')
@section('extra-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="{{asset('stdev/css/badge-status.css')}}">
@endsection

@section('page-content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <h4 class="page-title col-9" >Thèmes de Mémoires</h4>
                <div class="col-3">
                    <div class="d-grid d-md-none gap-2 d-flex justify-content-end ">
                        <a class="btn text-white btn-sm btn-floating"  style="background-color: #55acee;" href="#!" role="button" data-mdb-modal-init data-mdb-target="#TMModal">
                            <i class="fa-solid fa-add"></i>
                        </a>
                    </div>

                    <div class="d-grid d-none d-md-block gap-2 d-md-flex justify-content-md-end">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;"  role="button" data-mdb-modal-init data-mdb-target="#TMModal">
                            <i class="fa-solid fa-add"></i>
                            Ajouter
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-striped mt-3" id="dataTable"></table>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('extra-scripts')

    <div class="modal fade" id="TMModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau Thème</h5>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bdForm" enctype="multipart/form-data">
                        @csrf
                        {{-- <label for="squareSelect">Categories</label>
                        <select class="form-control input-square" id="categories" name="categories" >
                           @if(!empty($categories))
                                @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endforeach
                            @endif
                        </select> --}}
                        <div class="row">
                            <div class="mb-1 col-12 ">
                                <label for="theme" class="col-form-label" >Thème</label>
                                <input type="text" class="form-control" id="theme" name="theme" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="generale" class="col-form-label">Objectifs Générales</label>
                            <textarea class="form-control" id="generale" name="generale"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="specifique" class="col-form-label">Objectifs Spécifiques</label>
                            <textarea class="form-control" id="specifique" name="specifique"></textarea>
                        </div>
                        <div class="mb-1 col-12 ">
                            <label for="lieu_collect" class="col-form-label" >Lieu de collecte</label>
                            <input type="text" class="form-control" id="lieu_collect" name="lieu_collect" />
                        </div>
                        <div class="mb-1 col-12 ">
                            <label for="annee_collect" class="col-form-label" > Année de collecte</label>
                            <select id="annee_collect"class="form-control" name="annee_collect">
                                <script>
                                    // Génère dynamiquement les options pour les années
                                    const startYear = 1900; // Année de début
                                    const endYear = new Date().getFullYear(); // Année actuelle
                                    for (let year = endYear; year >= startYear; year--) {
                                        document.write(`<option  value="${year}">${year}</option>`);
                                    }
                                </script>
                            </select>
                        </div>
                        <h6 class="fs-6">Protocoles</h6>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Licences</label>
                            <input type="file" class="form-control" id="licence" name="licence" accept=".pdf">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Master</label>
                            <input type="file" class="form-control" id="master" name="master" accept=".pdf">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Doctorat</label>
                            <input type="file" class="form-control" id="doctorat" name="doctorat" accept=".pdf">
                        </div>
                        <input type="text" value="" name="uuid" id="uuid" hidden/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Annulé</button>
                            <button type="button" class="btn btn-primary" data-mdb-ripple-init id="TMFormSubmit" data-action="add"><span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" hidden ></span>Enregistrer
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
    <script type="module" src="{{asset('admin/js-data/all-theme-memoire.js')}}"></script>
@endsection
