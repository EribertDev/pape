@extends('admin.master')
@section('extra-style')
<link rel="stylesheet" href="{{asset('admin/assets/css/dash.css')}}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@2.0.1/dist/chartjs-plugin-zoom.min.js"></script>
<style>
    .chart-container {
    width: 100%;
    height: 80vh; /* Hauteur plus grande sur mobile */
    max-height: 600px;
    overflow-x: auto; /* Défilement horizontal si nécessaire */
}

@media (max-width: 768px) {
   /* Version desktop par défaut */
.chart-container-mobile {
    height: 60vh;
    width: 80vw;
    margin: 0 auto;
}

/* Adaptation mobile */
@media (max-width: 768px) {
    .chart-container-mobile {
        height: 80vh !important; /* Force la hauteur sur mobile */
        width: 100vw !important; /* Prend toute la largeur */
        margin: 0 -1rem; /* Compense le padding parent */
        padding-right: 15px; /* Empêche le débordement */
    }
    
    #myChart {
        min-width: 120%; /* Agrandit le graphique */
        transform: scale(1.1); /* Zoom supplémentaire */
        transform-origin: left top;
    }
}

/* Pour les très petits écrans */
@media (max-width: 480px) {
    .chart-container-mobile {
        height: 90vh !important;
    }
    
    #myChart {
        min-width: 150%;
    }
}
}
</style>
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
        <div class=" mt-5">
        <!-- Sélecteur d'année -->
        <div class="year-selector">
            <div class="row align-items-center">
               
        <div class="col-md-2 text-end">
        <div class="text-center mb-4">
        <form action="{{ route('dashboard.export') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="start_date">
            <input type="hidden" name="end_date" >
            <button type="submit" class="btn btn-success">
                <i class="fas fa-file-excel me-2"></i>Exporter vers Excel
            </button>
        </form>
    </div>
                </div>
            </div>
        </div>
        
        <!-- Cartes de statistiques -->
        <div class="stat-grid">
            <div class="card card-stats card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-users"></i>
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
            
            <div class="card card-stats card-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Revenu encaissé</p>
                                <h4 class="card-title">{{$data['payementTotal']}} FCFA</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card card-stats card-warning">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-crown"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Travaux VIP en attente</p>
                                <h4 class="card-title"> {{$data['vip_attente']}} </h4>
                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card card-stats card-danger">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-file-alt"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Travaux Standard en attente</p>
                                <h4 class="card-title"> {{$data['standard_attente']}} </h4>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card card-stats card-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Travaux achevés</p>
                                <h4 class="card-title"> {{$data['commandeTaiter']}}  </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       
<div class="container">
    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form id="filterForm" action="{{ route('admin.dash') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="start_date" class="form-control" 
                               value="{{ $startDate }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date de fin</label>
                        <input type="date" name="end_date" class="form-control" 
                               value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Année</label>
                        <select class="form-select" id="yearSelect">
                            <option value="">Toutes les années</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" 
                                    @if(date('Y', strtotime($startDate)) == $year) selected @endif>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i>Filtrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-muted mb-0">Clients</h5>
                            <h2 class="mb-0">{{ $stats['total_clients'] }}</h2>
                        </div>
                        <div class="icon icon-shape bg-primary text-white rounded-circle">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-muted mb-0">Revenu total</h5>
                            <h2 class="mb-0">{{ number_format($stats['revenu_total'], 0, ',', ' ') }} FCFA</h2>
                        </div>
                        <div class="icon icon-shape bg-success text-white rounded-circle">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-muted mb-0">Travaux achevés</h5>
                            <h2 class="mb-0">{{ $stats['travaux_acheves'] }}</h2>
                        </div>
                        <div class="icon icon-shape bg-info text-white rounded-circle">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deuxième ligne de cartes -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-muted mb-0">Travaux VIP en attente</h5>
                            <h2 class="mb-0">{{ $stats['vip_en_attente'] }}</h2>
                        </div>
                        <div class="icon icon-shape bg-warning text-white rounded-circle">
                            <i class="fas fa-crown"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-muted mb-0">Travaux Standard en attente</h5>
                            <h2 class="mb-0">{{ $stats['standard_en_attente'] }}</h2>
                        </div>
                        <div class="icon icon-shape bg-danger text-white rounded-circle">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

         <!-- Graphiques -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Répartition par type</h5>
                    <canvas id="typeChart" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Évolution mensuelle</h5>
                    <canvas id="evolutionChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Bouton d'export -->
  
</div>













                    <div class="row">
                        <div class="chart-container-mobile" style="position: relative; height:70vh; width:100%; margin:0 -15px; overflow-x: auto;">
                            <canvas id="myChart" style="min-width: 600px;"></canvas>
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
    const isMobile = window.matchMedia("(max-width: 768px)").matches;
    const ctx = document.getElementById('myChart').getContext('2d');
    let gradientOrders = ctx.createLinearGradient(0, 0, 0, 400);
    gradientOrders.addColorStop(0, 'rgba(75, 192, 192, 0.4)');
    gradientOrders.addColorStop(1, 'rgba(75, 192, 192, 0)');

    let gradientRevenues = ctx.createLinearGradient(0, 0, 0, 400);
    gradientRevenues.addColorStop(0, 'rgba(255, 99, 132, 0.4)');
    gradientRevenues.addColorStop(1, 'rgba(255, 99, 132, 0)');

    new Chart(ctx, {
        type: 'line', // ou 'bar' selon votre préférence
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Nombre de commandes',
                data: @json($orderData),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: gradientOrders,
                borderWidth: 3,
             
                tension: 0.2,
                fill: true
                
                
            },
           
            {
                label: 'Revenus (F CFA)',
                data: @json($revenueData),
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: gradientRevenues,
                tension: 0.2,
                fill: true,
                yAxisID: 'y1',
                pointStyle: 'rectRounded',
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Essential pour le contrôle mobile
            devicePixelRatio: isMobile ? 2 : 1, // Améliore la netteté sur mobile
            layout: {
            padding: isMobile ? 10 : 20
        },
            interaction: {
                mode: 'nearest',
                intersect: false,
                axis: 'x'
            }, onHover: (event, elements) => {
                if (isMobile) {
                    event.native.target.style.cursor = 'pointer';
                }
            },
            plugins: {
            title: {
                font: { size: isMobile ? 16 : 18 }
            },
            zoom: {
                zoom: {
                    wheel: { enabled: false },
                    pinch: { enabled: true },
                    mode: 'x'
                },
                pan: {
                    enabled: true,
                    mode: 'x'
                }
            },
            legend: {
                position: isMobile ? 'bottom' : 'top',
                labels: {
                    font: { 
                        size: isMobile ? 12 : 14 
                    }
                }
            },
            tooltip: {
                bodyFont: { size: isMobile ? 12 : 14 },
                titleFont: { size: isMobile ? 14 : 16 },
                padding: isMobile ? 8 : 12
            }
        },
        scales: {
            x: {
                ticks: {
                    font: {
                        size: isMobile ? 10 : 12
                    },
                    maxRotation: isMobile ? 45 : 0,
                    minRotation: isMobile ? 45 : 0
                }
            },
            y: {
                ticks: {
                    font: { size: isMobile ? 10 : 12 }
                }
            },
            y1: {
                position: 'right',
                ticks: {
                    font: { size: isMobile ? 10 : 12 },
                    callback: function(value) {
                        return isMobile ? `${value/1000}k` : `${Number(value).toLocaleString()} F CFA`;
                    }
                }
            }
        }
        
        }
            });
            // Animation de fondu au chargement
document.getElementById('myChart').style.opacity = 0;
setTimeout(() => {
    document.getElementById('myChart').style.transition = 'opacity 0.5s ease-in';
    document.getElementById('myChart').style.opacity = 1;
}, 500);


</script>
 <script>
    // Graphique de répartition par type
    const typeCtx = document.getElementById('typeChart').getContext('2d');
    const typeChart = new Chart(typeCtx, {
        type: 'pie',
        data: {
            labels: ['Standard', 'VIP'],
            datasets: [{
                data: [{{ $stats['repartition_type']['standard'] ?? 0 }}, {{ $stats['repartition_type']['vip'] ?? 0 }}],
                backgroundColor: ['#36a2eb', '#ffce56']
            }]
        }
    });

    // Graphique d'évolution mensuelle
    const evolutionCtx = document.getElementById('evolutionChart').getContext('2d');
    const evolutionChart = new Chart(evolutionCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($stats['evolution_mensuelle']->pluck('month')) !!},
            datasets: [{
                label: 'Travaux créés',
                data: {!! json_encode($stats['evolution_mensuelle']->pluck('total')) !!},
                borderColor: '#4bc0c0',
                tension: 0.1
            },
            {
                label: 'Travaux achevés',
                data: {!! json_encode($stats['evolution_mensuelle']->pluck('termines')) !!},
                borderColor: '#ff6384',
                tension: 0.1
            }]
        }
    });

    // Gestion du changement d'année
    document.getElementById('yearSelect').addEventListener('change', function() {
        const year = this.value;
        if (year) {
            document.querySelector('input[name="start_date"]').value = year + '-01-01';
            document.querySelector('input[name="end_date"]').value = year + '-12-31';
            document.getElementById('filterForm').submit();
        }
    });
</script>
@endsection


    
