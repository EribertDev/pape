@extends('clients.master-1')
@section('extra-style')
    <!-- MAGNIFIC CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}" />
    <link rel="stylesheet" href="{{asset('clients/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('clients/js-simple-loader-main/loader.js')}}"  ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
    <style>
        /* Pour Chrome et Safari */
        .no-spinner::-webkit-inner-spin-button,
        .no-spinner::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Pour Firefox */
        .no-spinner {
            -moz-appearance: textfield; /* Masquer le bouton dans Firefox */
        }
    </style>
@endsection

@section('page-content')
   
    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Réclamation</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->
    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <h2 class="fw-bold text-center">Réclammer vos payement ici</h2>
           <div class="container ml-2">
               <p class="text-center">Renseigner les information liés à la commande et au payement</p>
           </div>
            <div class="row  d-flex justify-content-center">
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <!-- Form -->
                        <form id="reclationForm" class="form border border-1 border-opacity-50 p-3" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-card">
                                    <div class="row">                                                        
                                            <div class="row">
                                                <div class="form-group col-12 col-md-6">
                                                    <label class="fieldlabels" for="nbrPage" >ID Payement</label>
                                                    <input type="number" name="id_pay" id="id_pay" class="no-spinner">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label class="fieldlabels" for="nbrExemplaire">Réference de la commande</label>
                                                    <input type="text" name="cmd_ref" id="cmd_ref" class="no-spinner">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="button">
                                    <a  id="reclamationSubmit" type="button" class="btn">Réclamer</a>
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
        </div>
    </section>
    <!--/ End Checkout -->

    <!-- END TESTIMONIALS -->
    <section class="faq_area section-padding">
        <div class="container">
            <div class="section-title-two">
                <h2>FAQ Commande</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How does it create content?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that. Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Is the content original?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that. Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How to write long-form blogs?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that. Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    How do I view my usage?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that. Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    How does it create content?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that. Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple &amp; easy gotta love that.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                    </div>
                </div><!-- END COL  -->
            </div><!--END  ROW  -->
        </div><!--- END CONTAINER -->
    </section>
@endsection

@section('extra-scripts')
    <!-- Vertically centered scrollable modal -->
    <div class="modal fade" id="conditionOfUseModale" tabindex="-1" aria-labelledby="scrollableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="scrollableModalLabel">Condition d'utilisation et de vente</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h3>Cher client,</h3>
                        <p>Nous vous remercions d'avoir choisi SyRRaM pour la rédaction de votre mémoire ou thèse. Nous souhaitons toutefois vous informer de certaines conditions d'utilisation de nos services :</p>
                        <ul>
                            <li>🔒 <strong>Confidentialité :</strong> Chez SyRRaM, nous nous engageons à garder confidentielles vos informations personnelles et ne les diffuserons qu'avec votre autorisation écrite.</li>
                            <li>✍️ <strong>Auteur :</strong> En commandant la rédaction de votre mémoire ou thèse par SyRRaM, vous devenez l'auteur exclusif de votre travail. SyRRaM ne pourra jamais revendiquer la paternité de votre recherche. Cependant, nous nous réservons le droit de publier votre travail dans notre moteur de recherche interne, en indiquant vos informations personnelles clés comme auteur de ce document.</li>
                            <li>💰 <strong>Paiement :</strong> Vous êtes tenu de régler les frais de prise de contact avant le démarrage de la rédaction par nos services compétents.</li>
                            <li>⚠️ <strong>Avertissement :</strong> En cas de non-règlement de la totalité des frais de rédaction, vous perdrez vos droits d'auteur sur votre travail de recherche.</li>
                        </ul>
                </div>
                <div class="content px-5 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkBoxConditionId" style="color: #2eca7f">
                        <label class="form-check-label text-center fs-6" for="checkBoxConditionId" style="color: #2eca7f">
                            j'ai lu les termes et conditions
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_one btn btn-secondary" data-bs-dismiss="modal">Annulé</button>
                    <button type="button" class="btn_one  btn btn-primary border-0" id="acceptedConditionBtn"><span class="spinner-border spinner-border-sm" aria-hidden="true" hidden></span><span>j'accepte</span></button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('clients/assets/js/nicesellect.js?'.Str::uuid())}}"></script>
    <script type="text/javascript">
         
    </script>
   
    <script type="module" src="{{asset('clients/js-data/reclamation.js?'.Str::uuid())}}">
    </script>


   
    
@endsection
