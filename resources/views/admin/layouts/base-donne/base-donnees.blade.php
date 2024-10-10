@extends('admin.master')
@section('extra-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="{{asset('stdev/css/badge-status.css')}}">
@endsection

@section('page-content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <h4 class="page-title col-9" >Base De Donnée</h4>
                <div class="col-3">
                    <div class="d-grid d-md-none gap-2 d-flex justify-content-end ">
                        <a class="btn text-white btn-sm btn-floating"  style="background-color: #55acee;" href="#!" role="button" data-mdb-modal-init data-mdb-target="#baseDonneModal">
                            <i class="fa-solid fa-add"></i>
                        </a>
                    </div>

                    <div class="d-grid d-none d-md-block gap-2 d-md-flex justify-content-md-end">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;"  role="button" data-mdb-modal-init data-mdb-target="#baseDonneModal">
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

    <div class="modal fade" id="baseDonneModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau membre</h5>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bdForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-1 col-12 ">
                                <label for="title" class="col-form-label" >Titre</label>
                                <input type="text" class="form-control" id="title" name="title" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-1 col-12">
                                <label for="amount" class="col-form-label">Prix</label>
                                <input type="number" class="form-control" id="amount" name="amount"/>
                            </div>
                            <div class="mb-1 col-12 ">
                                <label for="path" class="col-form-label">fichier (*.zip)</label>
                                <input type="file" class="form-control" id="path" name="path"  />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <input type="text" value="" name="uuid" id="uuid" hidden/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Annulé</button>
                            <button type="button" class="btn btn-primary" data-mdb-ripple-init id="bdFormSubmit" data-action="add"><span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" hidden ></span>Enregistrer
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
    <script type="module" src="{{asset('admin/js-data/all-base-donne.js')}}"></script>
@endsection
