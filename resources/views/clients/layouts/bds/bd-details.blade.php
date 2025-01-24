@extends('clients.master-1')
@section('extra-style')
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}" />
    <link rel="stylesheet" href="{{asset('clients/js-simple-loader-main/loader.css')}}" />
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
    <script  src="{{asset('clients/js-simple-loader-main/loader.js')}}"  ></script>
@endsection

@section('page-content')
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Boutique de Base de Données</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <div class="prdct_dtls_page_area section-padding">
        <div class="container">
            <div class="row">
                <!-- Product Details Image -->
                <div class="col-md-6 col-xs-12">
                    <div class="pd_img fix">
                        <a class="venobox" href="assets/images/shop/3.jpg"><img src="{{asset('clients/assets/images/shop/3.jpg')}}" class="img-fluid" alt=""></a>
                    </div>
                </div>
                <!-- Product Details Content -->
                <div class="col-md-6 col-xs-12">
                    <div class="prdct_dtls_content">
                        <h1 class="fs-5 fw-bold  mb-3" style="color: #2eca7f">{{strtoupper($bd->name)}}</h1>
                        <div class="pd_price_dtls fix">
                            <!-- Product Price -->
                            <div class="pd_price">
                                <span class="new">{{$bd->amount.' F cfa(XOF)'}} </span>
                            </div>
                            <!-- Product Ratting -->
                            <div class="pd_ratng">
                                <div class="rtngs">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pd_text">
                            <br/>
                            <h4 class="fs-6 fw-bold  mb-3">Description :</h4>
                            <p>{{Str::limit($bd->description, 150)}}</p>
                        </div>
                        <div class="pd_clr_qntty_dtls fix">

                          {{--  <div class="pd_clr">
                                <h4>color:</h4>
                                <a href="#" class="active" style="background: #ffac9a;">color 1</a>
                                <a href="#" style="background: #ddd;">color 2</a>
                                <a href="#" style="background: #000000;">color 3</a>
                            </div>

                            <div class="pd_qntty_area">
                                <h4>quantity:</h4>
                                <div class="pd_qty fix">
                                    <input value="1" name="qttybutton" class="cart-plus-minus-box" type="number">
                                </div>
                            </div>
                        --}}

                        </div>
                     
                        @php
                            $user_id = Auth::user()->id ?? '';
                            $bd_uuid =  $bd->uuid;
                            $bd_id = \App\Models\BaseDonne::where('uuid', $bd_uuid)->value('id');
                            $Paidpayment =  \App\Models\Payement::where('base_id' , $bd_id)
                            ->where('user_id', $user_id)
                            ->where('status_id', 20)
                            ->first();
                                                   
                                
                            // Récupération des paiements correspondant aux conditions
                            $payments = \App\Models\Payement::where('base_id', $bd_id)
                                ->where('user_id', $user_id)
                                ->get()  ; // Utilisez `get()` pour obtenir tous les résultats
                            $PendingPayments = $payments->where('status_id', 3)->last();                  
                            
                            // Récupération des paiements correspondant aux conditions
                            $payments = \App\Models\Payement::where('base_id', $bd_id)
                                ->where('user_id', $user_id)
                                ->get(); // Utilisez `get()` pour obtenir tous les résultats
                                                    
                       @endphp
                        @if( $Paidpayment)
                           
                            <button class="btn_one border-0 download" type="button"
                                data-uuid="{{ $bd->uuid }}"
                                data-pay-id="{{  $payment->id ?? '' }}"
                                data-pay-status="payer">
                                <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span>
                                <span role="status">Télécharger</span>
                            </button>
                          
                       
                           
                           
                        @elseif(!empty($PendingPayments))

                            <div class="pd_btn fix">
                                <button class="btn_one border-0 payer" type="button"   data-amount-type ="BD" data-uuid ="{{$bd->uuid}}"  data-pay-id="{{ $payment->id ?? '' }}">
                                    <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> Acheter</span>
                                </button>
                            
                            
                                <button class="btn_two border-0 payer_confirme ms-2 " type="button"   data-pay-id="{{$PendingPayments->id ?? '' }}"
                                    data-pay-status="{{ strtolower($PendingPayments->status->name ?? '') }}"
                                    >
                                        <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> J'ai payé</span>
                                    </button> 
                                
                            </div>
                        @else
                            <div class="pd_btn fix">
                                <button class="btn_one border-0 payer" type="button"   data-amount-type ="BD" data-uuid ="{{$bd->uuid}}"  data-pay-id="{{ $payment->id ?? '' }}">
                                    <span class="spinner-border spinner-border-sm spinner me-2" aria-hidden="true" hidden></span><span role="status"> Acheter</span>
                                </button>
                            </div>
                        @endif
                        <!--<div class="pd_share_area fix">
                            <h4>Partager :</h4>
                            <div class="pd_social_icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-vimeo"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </div>
                        -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="pd_tab_area fix">
                        <ul class="pd_tab_btn nav nav-tabs" role="tablist">
                            <li>
                                <a class="active" href="#description" role="tab" data-bs-toggle="tab" aria-selected="true">Description</a>
                            </li>
                           <!-- <li>
                                <a href="#information" role="tab" data-bs-toggle="tab" aria-selected="false" class="" tabindex="-1">Commentaire</a>
                            </li>
                            -->
                            <li>
                                <a href="#reviews" role="tab" data-bs-toggle="tab" aria-selected="false" class="" tabindex="-1">Ajouter commentaire</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active show" id="description">
                               <p>
                                   {{$bd->description}}
                               </p>
                            </div>

                           <!-- <div role="tabpanel" class="tab-pane fade" id="information">
                                <div class="pda_rtng_area fix">
                                    <h4>4.5 <span>(Overall)</span></h4>
                                    <span>Based on 9 Comments</span>
                                </div>
                                <div class="rtng_cmnt_area fix">
                                    <div class="single_rtng_cmnt">
                                        <div class="rtngs">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span>(4)</span>
                                        </div>
                                        <div class="rtng_author">
                                            <h3>John Doe</h3>
                                            <span>11:20</span>
                                            <span>6 May 2023</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost rud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost.</p>
                                    </div>

                                </div>
                            </div>
                        -->
                            <div role="tabpanel" class="tab-pane fade" id="reviews">

                                <div class="col-md-6 rcf_pdnglft">
                                    <div class="rtng_cmnt_form_area fix">
                                        <h3>Commentaire</h3>
                                        <div class="rtng_form">
                                            <form action="#">
                                                <div class="input-area"><input type="text" placeholder="Nom & Prénom"></div>
                                                <div class="input-area"><input type="text" placeholder="Email"></div>
                                                <div class="input-area"><textarea name="message" placeholder="Commentaire"></textarea></div>
                                                <input class="btn acc_btn" type="submit" value="Envoyer">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
<script type="module" src="{{asset('clients/js-data/bd.js?'.Str::uuid())}}"></script>
@endsection
