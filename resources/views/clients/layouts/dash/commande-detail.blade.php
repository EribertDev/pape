@extends('clients.master-1')
@section('extra-style')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/profile.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('stdev/css/badge-status.css'))}}" />
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>

@endsection

@section('page-content')
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s"
                     data-wow-offset="0"
                     style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Mon espace Client</h1>
                    {{-- <ul>
                         <li><a href="index.html">Mon espace Client</a></li>
                         <li> / Cart</li>
                     </ul>--}}
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>

    <div class="container-fluid" style="background-color: #f6f6f6">
        <div class="row">
            <div class="col-lg-3 col-sm-12 col-xs-12 mt-5 pt-5">
                <div><h2 class="fw-bold mb-4">Salut {{ session('clientInfo') ->fist_name}} 👋</h2></div>
                <div class="sidebar-post">
                    <div class="sidebar_title"><h4>Tableau de Bord</h4></div>
                    <div class="sidebar-banner">
                        <a class="profil-link-active" href="{{route('dash.client')}}">Mes commandes</a>
                        <hr>
                        {{-- <a class="profil-link" href="{{route('pay.reclamation')}}">Réclamtion</a>
                        <hr> --}}
                        {{-- <a class="profil-link" href="#">Mes achats</a>
                        <hr>--}}
                        <a class="profil-link" href="{{route('client.profile')}}">Profile</a>
                    </div><!-- END SOCIAL MEDIA POST -->
                </div><!-- END SIDEBAR POST -->
            </div><!--- END COL -->
            <div class="col-lg-9 col-sm-12 col-xs-12">
                <div class="prdct_dtls_page_area section-padding">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 bg-white">
                                <div class="prdct_dtls_content bg-white">

                                    <a class="pd_title" href="#">{{$commande->service?->name}}</a>
                                    <div class="pd_price_dtls fix">
                                        @php
                                            $badge ='badge-'.$commande->status->name;
                                            $badge = strtolower($badge);
                                            $badge = str_replace(array(' ', 'é'), array('-', 'e'), $badge);
                                        @endphp
                                        <p class="mb-2"><span class="fw-bold text-black fs-6">Status :</span> <span
                                                class=" badge {{$badge}}">{{$commande->status->name}}</span></p>
                                        <p class="mb-2"><span class="fw-bold text-black fs-6">Discipline :</span> <span
                                                class="fs-6">{{$commande->discipline->name}}</span></p>
                                        <p class="mb-2"><span class="fw-bold text-black fs-6">Délais :</span> <span
                                                class="fs-6">{{$commande['deadline']}}</span></p>
                                        <p class="mb-2"><span class="fw-bold text-black fs-6">Montant :</span> <span
                                            class="fs-6">{{$commande['amount']}} (XOF) F cfa</span></p>
                                        <p><span class="fw-bold text-black">Sujet : </span>{{$commande['subject']}}</p>
                                        <div class="pd_text">
                                        </div>
                                        @php
                                            $service = $commande->service?->name;
                                            $service = strtolower($service);
                                            $status = strtolower($commande->status->name);
                                            use App\Models\FilePatchOfCommande;

                                        // Récupérer les informations du fichier associé à une commande
                                            $file = FilePatchOfCommande::where('commande_id', $commande->id)->first();
                                            $file=(new FilePatchOfCommande())->getFinalByIdCommande($commande['id']);
                                            $fileDescription = strtolower($file->description ?? ''); // Description du fichier
                                            $payments = $commande->payments ?? []; // Liste des paiements
                                            $totalAmount = $commande->amount; // Montant total
                                               $amountPaid = collect($commande->payments)->where('status.id', '20')->sum('amount');
                                                $lastPayment = $commande->payments->last();
                                                $lastPaidPayment = $commande->payments->where('status.id', '20')->last();

                                            $amountRemaining = $totalAmount - $amountPaid; // Reste à payer

                                                $allPaymentsPaid = collect($commande->payments)->every(function ($payment) {
                                                return strtolower($payment->status->name) === "payer";
                                                                           });


                                        @endphp
                                        @if ( $status!=="en attente")

                                            @if (!empty($commande->payments)  && $fileDescription === "protocole" )
                                                <p>Le document disponible est un protocole. </p>
                                                @if (  $amountPaid >= $totalAmount / 2 )
                                                    <p>Vous avez payé la première tranche. Vous pouvez télécharger le document.</p>
                                                    <button class="btn_one border-0 download" type="button"
                                                        data-uuid="{{ $commande->uuid }}"
                                                        data-pay-id="{{  $lastPaidPayment->id ?? '' }}"
                                                        data-pay-status="payer">
                                                        <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span>
                                                        <span role="status">Télécharger</span>
                                                    </button>
                                                    
                                                @else
                                                    <p> Vous paierez seulement la moitié ({{ $totalAmount / 2 }}) pour pouvoir télécharger.</p>                                                    
                                                    <button class="btn_one border-0 payer" type="button"  id="editBtn" data-amount-type ="PS" data-uuid ="{{$commande->uuid}}">
                                                        <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> Payer</span>
                                                    </button>
                                                                                                        
                                                    @if(!empty($commande->payments))
                                                    <button class="btn_two border-0 payer_confirme ms-2 " type="button"   data-pay-id="{{ $lastPayment->id ?? '' }}"
                                                        data-pay-status="{{ strtolower($lastPayment->status->name ?? '') }}"
                                                        >
                                                            <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> J'ai payé</span>
                                                        </button> 
                                                                                                            
                                                    @endif  
                                                @endif                                              
                                            @elseif (!empty($commande->payments) && count($commande->payments) > 0 && $fileDescription === "complete" )
                                                <p>Le document disponible est la rédaction complete. </p>
                                                @if ($amountPaid === $totalAmount )
                                                    <p>Vous avez entièrement payé {{ $totalAmount }}. Vous pouvez télécharger le document.</p>
                                                    <button class="btn_one border-0 download" type="button"
                                                        data-uuid="{{ $commande->uuid }}"
                                                        data-pay-id="{{ $payments[0]->id ?? '' }}"
                                                        data-pay-status="payer">
                                                        <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span>
                                                        <span role="status">Télécharger</span>
                                                    </button>
                                                @elseif ($amountPaid > 0  )
                                                    <p>Vous avez déjà payé {{ $amountPaid }}. Il vous reste {{ $amountRemaining }} à régler.</p>
                                                
                                                    <button class="btn_one border-0 payer" type="button"  id="editBtn" data-amount="{{ $amountRemaining }}" data-amount-type ="PP" data-uuid ="{{$commande->uuid}}">
                                                        <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> Payer</span>
                                                    </button>
                                                    
                                                    @if(!empty($commande->payments))
                                                    <button class="btn_two border-0 payer_confirme ms-2 " type="button"   data-pay-id="{{ $lastPayment->id ?? '' }}"
                                                        data-pay-status="{{ strtolower($lastPayment->status->name ?? '') }}"
                                                        >
                                                            <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> J'ai payé</span>
                                                        </button> 
                                                                                                            
                                                    @endif 
                                                @else
                                                                                            
                                                    <button class="btn_two border-0 payer_confirme ms-2 " type="button" data-pay-id = "{{$commande->payments[0]->id}}"
                                                        data-pay-status = "{{$lastPayment->status->name}}"
                                                        >
                                                        <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> J'ai payé</span>
                                                    </button>
                                          
                                                @endif


                                            
                                            @elseif ( $fileDescription === "protocole_repertoire" )
                                                @if ($amountPaid === $totalAmount  )
                                                    <p>Vous avez déjà payé {{ $amountPaid }}. Vous pouvez télécharger votre protocole</p>
                                                    <button class="btn_one border-0 download" type="button"
                                                            data-uuid="{{ $commande->uuid }}"
                                                            data-pay-id="{{ $lastPaidPayment->id ?? '' }}"
                                                            data-pay-status="payer">
                                                            <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span>
                                                            <span role="status">Télécharger</span>
                                                        </button>
                                                @elseif ($amountPaid < $totalAmount)
                                                    <p>Le protocole du thème que vous avez choisi est disponible. Vous pouvez procéder au paiement pour y accéder dès maintenant.</p>
                                                    <button class="btn_one border-0 payer" type="button"  id="editBtn" data-amount-type ="PS" data-uuid ="{{$commande->uuid}}">
                                                        <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> Payer</span>
                                                    </button>
                                                    @if(!empty($commande->payments))
                                                    <button class="btn_two border-0 payer_confirme ms-2 " type="button"   data-pay-id="{{ $lastPayment->id ?? '' }}"
                                                        data-pay-status="{{ strtolower($lastPayment->status->name ?? '') }}"
                                                        >
                                                            <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> J'ai payé</span>
                                                        </button> 
                                                                                                            
                                                    @endif 
                                                @endif

                                            @else
                                                <button class="btn_one border-0 payer" type="button"  id="editBtn" data-amount-type ="PS" data-uuid ="{{$commande->uuid}}">
                                                    <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> Payer</span>
                                                </button>         
                                            @endif
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xs-12 bg-white mt-3">
                                <div role="tabpanel" class="tab-pane fade show active" id="description">
                                    <p class="fw-bold fs-6 mt-2 text-black">Description</p>
                                    <p> {{$commande['description']}} </p>
                                </div>
                            </div>

                            <div class="col-xs-12 bg-white mt-3">
                                <div role="tabpanel" class="tab-pane fade show active" id="description">
                                    <p class="fw-bold fs-6 mt-2 text-black">Fichier joint</p>
                                    @if ($commande->filesPath && count($commande->filesPath) > 0)
                                       <span>
                                        * {{ strtolower($commande->filesPath[0]->reference) }}
                                            <a href="{{ asset('storage/' . $commande->filesPath[0]->path) }}" download="{{ basename($commande->filesPath[0]->path) }}">
                                                <i class="ti-download  mx-2"></i>
                                            </a>
                                       </span>

                                    @else
                                        <p>Aucun fichier joint disponible.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- END COL-->
        </div><!-- END ROW-->
    </div>
@endsection

@section('extra-scripts')
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="embed" style="width: 500px; height: 420px;position:absolute;" ></div>
            <div class="modal-body">
                <div class="text-center">
                    <h4 class="modal-title text-center fw-bold" id="exampleModalLabel">Succès</h4>
                    <div>
                        <img class="mt-3" src="{{asset('clients/assets/images/icon/valide.png')}}" alt="" style="width: 70px;height: 70px">
                    </div>
                    <div>
                        <h5 class="mt-3" id="s_title_msg">Paiement éffectue avec succès</h5>
                        <p class="text-muted" id="s_msg" >Merci pour votre confiance</p>
                    </div>
                    <button type="button" class="btn_two mt-3 cancel__pay" data-bs-dismiss="modal">ok</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="payErrorModal" tabindex="-1" aria-labelledby="payErrorModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="embed" style="width: 500px; height: 420px;position:absolute;" ></div>
            <div class="modal-body">
                <div class="text-center">
                    <h4 class="modal-title text-center fw-bold" id="exampleModalLabel">Erreur</h4>
                    <div>
                        <img class="mt-2" src="{{asset('clients/assets/images/icon/caution.png')}}" alt="" style="width: 70px;height: 70px">
                    </div>
                    <div>
                        <h5 class="mt-2" id="e_title_msg">Paiement échoué ou annulé</h5>
                        <p class="text-muted" id="e_msg">Si votre compte a été débité, veuillez cliquer sur le bouton "J'ai Payer" pour vérifier votre paiement ou contactez-nous.</p>
                    </div>
                    {{-- <div class="text-start">
                        <p class="text-muted ms-4">Référence commande : <span id="ref__cmd"></span></p>
                        <p class="text-muted ms-4">Id payement : <span id="id__pay"></span></p>
                    </div> --}}
                    <div class="d-flex justify-content-center mt-2 gap-3">
                        <button type="button" class="btn_two mt-3 cancel__pay" data-bs-dismiss="modal" id="cancel__pay">OK</button>
                        {{-- <button type="button" class="btn_one mt-3 border-0" >Réclamation</button> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
    <script src="{{asset('clients/assets/js/nicesellect.js')}}"></script>
    <script type="text/javascript">
        $('select').niceSelect();
    </script>
    <script type="module" src="{{asset('clients/js-data/dash.js?'.Str::uuid())}}"></script>
@endsection
