@extends('admin.master')
@section('extra-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="{{asset('stdev/css/badge-status.css')}}">

@endsection

@section('page-content')
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Commandes</h4>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Nouvelles</div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped mt-3" id="newCommandeTable"></table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Approuvées</div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped mt-3" id="commandeTable">
                        <thead>
                        <tr>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="{{asset('admin/js-data/all-commande.js')}}"></script>
@endsection