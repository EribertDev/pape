@extends('admin.master')
@section('extra-style')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection

@section('page-content')
    <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Tableau de bord</h4>
                @if(session()->has('role')&& session()->get('role') == 'Affilier')
                   @php
                     if (session()->has('adminInfo')) {
                        $adminInfo = session()->get('adminInfo');
                    }
                   @endphp
                    <h6 class="page-title">Nom : {{ $adminInfo->last_name}}</h6>
                    <h6 class="page-title">Prénoms : {{ $adminInfo->fist_name}}</h6>
                    <h6 class="page-title">Code : {{ $data['code_af']}}</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-stats card-warning">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="la la-users"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">Commandes Total du mois</p>
                                                <h4 class="card-title">{{$data['afTotalMonth']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-stats card-success">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="la la-bar-chart"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">Gain total du mois</p>
                                                <h4 class="card-title">{{$data['monthGain']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-stats card-warning">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="la la-users"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">Clients</p>
                                                <h4 class="card-title">{{$data['clientsTotal']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats card-success">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="la la-bar-chart"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">Revenu</p>
                                                <h4 class="card-title">{{$data['payementTotal']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats card-danger">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="la la-newspaper-o"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">Commande</p>
                                                <h4 class="card-title">{{$data['commandeTotal']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats card-primary">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="la la-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">Commande</p>
                                                <h4 class="card-title">{{$data['commandeTraiterTotal']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="chart-container" style="position: relative; height:60vh; width:80vw">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                @endif


                {{-- <div class="card">
                    <div class="card-header">
                        <div class="card-title">Les dernière commandes</div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped mt-3">
                            <thead>
                            <tr>
                                <th scope="col">Client</th>
                                <th scope="col">Service</th>
                                <th scope="col">Document</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td><button class="btn btn-primary btn-sm fs-4"><i class="la la-eye"></i></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Les dernière vente</div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped mt-3">
                            <thead>
                            <tr>
                                <th scope="col">Client</th>
                                <th scope="col">Service</th>
                                <th scope="col">Document</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td><button class="btn btn-primary btn-sm fs-4"><i class="la la-eye"></i></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Base de donné</div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped mt-3">
                            <thead>
                            <tr>
                                <th scope="col">Client</th>
                                <th scope="col">Service</th>
                                <th scope="col">Document</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td><button class="btn btn-primary btn-sm fs-4"><i class="la la-eye"></i></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
@endsection

@section('extra-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const ctx = document.getElementById('myChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'line', // ou 'bar' selon votre préférence
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Nombre de commandes',
                data: @json($orderData),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.2,
                fill: true
            },
            {
                label: 'Revenus (F CFA)',
                data: @json($revenueData),
                borderColor: 'rgb(255, 99, 132)',
                tension: 0.2,
                fill: true,
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Statistiques des 9 derniers mois'
                }
            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Commandes'
                    }
                },
                y1: {
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Revenus (f CFA)'
                    },
                    grid: {
                        drawOnChartArea: false
                    }
                }
            }
        }
    });
</script>
@endsection
