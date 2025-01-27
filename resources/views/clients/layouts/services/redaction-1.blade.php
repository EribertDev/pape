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

        .btn-check + .btn {
        background-color: white;
        border: 1px solid #ced4da;
        color: #000;
    }

    .btn-check + .btn:hover {
        background-color: #f8f9fa;
        color: #000;
    }

    .btn-check:checked + .btn {
        background-color: #007bff; /* Couleur de fond lorsque le bouton est sélectionné */
        border-color: #007bff;
        color: white;
    }

    .btn-check:checked + .btn.btn-outline-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn-check + .btn.btn-sm {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }
 
    </style>
@endsection

@section('page-content')

    <!-- START SECTION TOP -->
    <section class="section-top">
    <style>

      
        @media (max-width: 768px) {
            .section-top {
                margin-top: 70px; /* Adapte l'espace pour les mobiles */
                padding: 50px 15px; /* Réduit le padding sur mobile */
            }
        }
    </style>
    
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Coaching en rédaction de mémoire et thèse</h1>
                    {{--<ul>
                        <li><a href="index.html">Home</a></li>
                        <li> / Chcekout</li>
                    </ul>--}}
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->
    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <h2 class="fw-bold text-center">Inscrivez-vous au programme PAPE pour rédiger rapidement, facillement et bien vos mémoires et thèses</h2>
           <div class="container ml-2">
               <p class="text-center">Renseigner l'information de votre document</p>
           </div>
            <div class="row  d-flex justify-content-center">
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <!-- Form -->
                        <form id="cmdForm" class="form border border-1 border-opacity-50 p-3" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-card">
                                    <div class="row">
                                        <div class=" col-12 ">
                                            <div class="row">
                                                <h4 class="text-center mb-4" >Informations personnelles  </h4>
                                                @if(Auth::check())
                                                    <div class="form-group col-6">
                                                        <label class="fieldlabels" for="nom">Nom</label>
                                                        <input type="text" id="nom" name="nom" value="{{session('clientInfo') ->fist_name }}" disabled>                                                    
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <label class="fieldlabels" for="faculte">Prénom</label>
                                                        <input  class="px-2 py-2" type="text" name="prenom" id="prenom" value="{{session('clientInfo') ->last_name }}" disabled />
                                                    </div> 
                                                    <div class="form-group col-6">
                                                        <label class="fieldlabels" for="nom">Téléphone</label>
                                                        <input type="text" id="telephone" name="telephone" value="{{session('clientInfo') ->phone_number }}" disabled>                                                    
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <label class="fieldlabels" for="faculte">Email</label>
                                                        <input  class="px-2 py-2" type="text" name="email" id="email" value="{{Auth::user()->email}}" disabled />
                                                    </div>
                                                @else
                                                <p>Veuillez vous connecter pour voir vos informations personnelles  </p> 
                                                @endif
                                                    
                                            </div>
                                            <h4 class="text-center mb-4" >Informations de la commande  </h4>
                                            <div id="step1" class="step">
                                                <div class="form-group my-3">
                                                    <label for="cars" class="fw-bold">Type de service***</label>
                                                    <select  name="typeService" id="typeService" required>
                                                        <option value="" selected disabled>Quels type de service souhaitez vous ?</option>

                                                        @if (!empty($options['typeService']))
                                                            @php
                                                                foreach ($options['typeService'] as $datas){
                                                                    echo '<option value='.$datas->reference.' data-montant = "'.$datas->prix.'">'.$datas->name.'</option>';
                                                                }
                                                            @endphp
                                                        @endif
                                                    </select>
                                                </div>
                                                {{--
                                                    <div class="form-group my-3">
                                                        <label for="cars">Type de document</label>
                                                        <select  name="typeDocument" id="typeDocument">
                                                            @php
                                                                foreach ($options['typeDocument'] as $datas){
                                                                    echo '<option value="'.$datas->reference.'">'.$datas->name.'</option>';
                                                                }
                                                            @endphp
                                                        </select>
                                                    </div>
                                                --}}
                                                <div class="form-group my-3">
                                                    <label for="cars" class="fw-bold">Discipline***</label>
                                                    
                                                    <select  name="dicipline" id="dicipline" required>
                                                    

                                                    @if (!empty($options['discipline']))
                                                    @php
                                                            foreach ($options['discipline'] as $datas){
                                                                echo '<option value="'.$datas->reference.'">'.$datas->name.'</option>';
                                                            }
                                                        @endphp
                                                    @endif
                                                    <option value="autre" >Autre</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                            
                                                    <div class="form-group ">
                                                        <label for="country" class="fw-bold">Pays*** </label>
                                                        <select name="pays" id="pays" class="form-control" required>
                                                            <option value="" selected disabled>-- Sélectionnez un pays --</option>
                                                            @foreach ($countries as $country )
                                                                <option  value="{{$country['name']}}"> {{$country['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group ">
                                                        <label class="fieldlabels fw-bold" for="universite">Université***</label>
                                                        <input  class="px-2 py-2" type="text" name="universite" id="universite" placeholder="Veuillez entrez votre université" required/>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group ">
                                                        <label class="fieldlabels  fw-bold" for="type_universite">Type d'université***</label>
                                                        <select name="type_universite" id="type_universite" class="form-control" required>
                                                            <option value="" selected disabled>---</option>
                                                            
                                                                <option  value="Publique">Publique</option>
                                                                <option  value="Privé"> Privé</option>
                                                           
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group mt-4">
                                                        <label class="fw-bold">Avez-vous besoin d'un stage ?</label>
                                                        <div class="mt-2 d-flex gap-3">
                                                            <!-- Bouton Oui -->
                                                            <input type="radio" id="needStageYes" name="needStage" value="yes" class="btn-check">
                                                            <label for="needStageYes" class="btn btn-outline-primary btn-sm rounded-pill">Oui</label>
                                                    
                                                            <!-- Bouton Non -->
                                                            <input type="radio" id="needStageNo" name="needStage" value="no" class="btn-check">
                                                            <label for="needStageNo" class="btn btn-outline-danger btn-sm rounded-pill">Non</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Champs conditionnels -->
                                                    <div id="stageDetails" class="mt-4" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="fieldlabels  fw-bold" for="structure">Stucture</label>
                                                            <select name="structure_stage" id="structure_stage" class="form-control">
                                                                <option value="" selected disabled>Quelles structure désirez vous</option>
                                                                
                                                                    <option  value="administration_publique">Administration Publique</option>
                                                                    <option  value="adlinistration_privee"> Administration Privée</option>
                                                                    <option  value="formation_sanitaire"> Formation Sanitaire</option>
                                                                    <option  value="institution_microfinance"> Institution de Microfinance</option>
                                                                    <option  value="anyway"> N'importe quelle structure</option>
                                                            
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="country" class="fw-bold">Commune </label>
                                                                                                                    
                                                            <select name="commune_stage" id="commune_stage" class="form-control">
                                                                <option value="" disabled selected>-- Sélectionnez une Commune --</option>
                                                                @foreach ($departements as $departement => $communes)
                                                                    <optgroup label="{{ $departement }}">
                                                                        @foreach ($communes as $commune)
                                                                            <option value="{{ $commune }}">{{ $commune }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            
                                                               
                                                                <!-- Ajoutez ici les autres départements et leurs communes -->
                                                            </select>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                           
                                            <button type="button"   class="btn btn-primary mt-3 next-btn" disabled>Suivant</button>
                                            </div>

                                            
                                      
                                        <div id="step2" class="step d-none">
                                            <div class="form-group">
                                                <label class="fw-bold">Voulez-vous choisir un thème du répertoire CESIE ?</label>
                                                <div class="mt-2 d-flex align-items-center">
                                                    <!-- Option Oui -->
                                                    <div class="form-check me-3">
                                                        <input type="radio" class="form-check-input" id="chooseYes" name="chooseTheme" value="yes" >
                                                        <label class="form-check-label" for="chooseYes">Oui</label>
                                                    </div>
                                                    <!-- Option Non -->
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="chooseNo" name="chooseTheme" value="no" >
                                                        <label class="form-check-label" for="chooseNo">Non</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="form-check form-check-inline mt-lg-5" >
                                                <input class="form-check-input" type="checkbox" id="check_choose" value="1" name="choose_theme" checked>
                                                <label class="form-check-label" for="check_choose">Chosire un theme</label>
                                            </div> -->

                                            <div class="form-group mt-2" id="div_subject"   style="display: none;">
                                                <label class="fieldlabels fw-bold" for="subject">Inscrivez votre thème</label>
                                                <input  class="px-2 py-2" type="text" name="subject" id="subject" placeholder="Veuillez entrez votre theme"  />
                                            </div>

                                            <div class="form-group mt-2">
                                                <input  class="px-2 py-2" type="text" name="amount" id="amount" placeholder="Veuillez entrez votre theme" hidden/>
                                              
                                            </div>

                                            <div class="form-group mt-2" id="div_theme"  style="display: none;">
                                                <label for="cars"  class="fw-bold">Thème de Recherche </label>
                                                <select name="theme" id="theme" hidden >
                                                    <option value="">Veuillez entrer votre theme</option>
                                                    @if (!empty($options['TMs']))
                                                        @php
                                                            foreach ($options['TMs'] as $datas){
                                                                echo '<option value="'.$datas->uuid.'" >'.$datas->title.'</option>';
                                                            }
                                                        @endphp
                                                    @endif
                                                </select>
                                            </div>
                                           
                                            <button type="button" class="btn btn-secondary prev-btn">Précédent</button>
                                            <button type="button" class="btn btn-primary next-btn " disabled >Suivant</button>
                                        </div>
                                    </div>
                                        <div id="step3" class="step d-none">
                                            <div class="row">
                                               
                                                <div class="form-group col-12">
                                                @php
                                                   // echo $dateLimit = $options['date'];
                                                @endphp
                                                    <label class="fieldlabels fw-bold">Date limite</label>
                                                    <input  class="px-2 py-2" type="date" name="deadline" id="deadline" placeholder="" value="" />
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="form-group ">
                                                <label for="descrip_file"  class="fw-bold">Ajouter un fichier (.pdf, .doc, .docx)</label>
                                                <input
                                                type="file"
                                                id="descrip_file"
                                                name="descrip_file"
                                                accept=".pdf, .doc, .docx"
                                                multiple />
                                            </div>
                                            <div class="form-group">
                                                <label class="fieldlabels fw-bold" for="description">Quel problème principal désirez vous résoudre à travers cette thématique ?</label>
                                                <textarea placeholder="Message" name="description" id="description" class="form-control mb-3" style="height: 150px;"></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="fieldlabels fw-bold" for="codeAf" >Code point focal (Si vous n'avez pas de code mettez 1000)</label>
                                                <input type="number" name="codeAf" id="codeAf" class="no-spinner" >
                                                <li><span id="promo-message"></span></li> 
                                            </div>
                        
                                            <button type="button" class="btn btn-secondary prev-btn">Précédent</button>
                                        </div>
                                        <div class="col-lg-8 col-12" >      
                                            <div class="order-details">
                                                <!-- Order Widget -->
                                                <div class="single-widget">
                                                    <h2>Coût de la prestation </h2>
                                                    <div class="content">
                                                        <ul>
                                                            <li>Montant normal<span id="montant">-----</span></li>
                                                            <li>Réduction<span id="montantReduit">-----</span></li>
                                                            <li>Montant à payer: <span id="montantFinal"> </span></li>
                        
                                                            
                                                        </ul>
                                                            
                                                    </div>
                                                </div>
                                                <!--/ End Payment Method Widget -->
                                                <!-- Button Widget -->
                                                <div class="single-widget get-button">
                                                    <div class="content">
                                                        <div class="button">
                                                            <a  id="commanderBtn" type="button" class="btn">  Envoyer</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/ End Button Widget -->
                                            </div>
                                        </div>  
                                    </div>
                                        
                        </form>
                        <!--/ End Form -->
                       
                           
                    </div>
                </div>
                
           
            </div>
        </div>
    </section>
    <!--/ End Checkout -->
    <!-- Start Shop Services Area  -->
    {{-- <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over $100</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Shop Services -->
    <!-- END TESTIMONIALS -->
    {{-- <section class="faq_area section-padding">
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
    </section> --}}
@endsection

@section('extra-scripts')
    <!-- Vertically centered scrollable modal -->
    <div class="modal fade" id="conditionOfUseModale" tabindex="-1" aria-labelledby="scrollableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="scrollableModalLabel">Condition d'utilisation</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="promo-success-message" class="alert alert-success" style="display: none;">
                        <!-- Le message du code promo valide sera inséré ici -->
                      </div>
                        <p class="mb-1">
                            La plateforme PAPE mise à votre disposition est soumise à des conditions d’utilisation. En accédant à cette plateforme, vous acceptez de vous soumettre à ces Conditions d’utilisation, aux directives et aux règles mentionnées dans cet accord. Si vous ne souhaitez pas accepter ces conditions, veuillez ne pas utiliser la plateforme.
                            Le présent Contrat définit les conditions qui s’appliquent à l’utilisation de ce site par tout utilisateur. Ainsi :
                        </p>
                        <p><strong>Article 1 : </strong> Le Programme d'Accompagnement Professionnel des Etudiants (PAPE) 📚 <br> Le PAPE est un programme destiné à :</p>

                        <ul class="mb-1">
                            <li>👉 Accorder aux étudiants une administration d'accueil (publique ou privée) pour la réalisation de son mémoire ou de sa thèse</li>
                            <li>👉 Coacher les étudiants et chercheurs dans la réalisation de leurs travaux de recherche (mémoire ou thèse)</li>
                            <li>👉 Accompagner ces étudiants et chercheurs dans la collecte et l'analyse à bonne date des données de terrain</li>
                            <li>👉 Former ces étudiants et chercheurs dans le processus de réalisation des travaux de recherche </li>
                        </ul>
                        <p class="mb-1">
                            <strong>Article 2 : Ethique</strong> 🤝<br>
                            Le PAPE n'est pas destiné à se substituer aux étudiants et chercheurs pour rédiger à leur place les travaux de recherche de fin de formation. Il est plutôt destiné à accompagner ces étudiants et chercheurs dans le processus de réalisation des travaux de recherche.
                        </p>
                        <p class="mb-1">
                            <strong>Article 3 : Rôle du PAPE </strong> 🎯<br>
                            Le PAPE permet aux étudiants et chercheurs de rédiger en cinq séances de coaching au maximum leur mémoire ou thèse.
                        </p>
                        <p class="mb-1">
                            <strong>Article 4 : Protection des données</strong> 🔒<br>
                            Le PAPE permet aux étudiants et chercheurs de rédiger en cinq séances de coaching au maximum leur mémoire ou thèse.
                        </p>
                        <p class="mb-1">
                            <strong>Article 5 : Démarches pour bénéficier du PAPE</strong> 📝<br>
                            Le PAPE permet aux étudiants et chercheurs de rédiger en cinq séances de coaching au maximum leur mémoire ou thèse.
                        </p>
                        <p class="mb-1">
                            <strong>Article 6 : Rémunération</strong> 💰<br>
                            Le coaching dans la rédaction des mémoires et thèses n'est pas gratuit et coût diffère selon le niveau d'étude. La plateforme fournit systématiquement le montant à payer par le postulant
                        </p>
                        <p class="mb-1">
                            <strong>Article 7 : Abandon du coaching</strong> 🚫<br>
                            Pendant le coaching, les étudiants et chercheurs qui disparaissent pendant plus de trois (03) mois et qui désirent continuer à nouveau sont astreints au paiement d'une pénalité d'abandon de 30% du montant du coaching.
                        </p>
                        <p class="mb-1">
                            <strong>Article 8 : Droit d'auteur</strong> ©️<br>
                            Le coaching du PAPE ne confère nullement à ce dernier le droit d'auteur sur les travaux coacher.
                        </p>
                        <p class="mb-1">
                            <strong>Article 9 :</strong><br>
                            Le PAPE est la propriété du Cabinet CESIE qui se réserve le droit de publier une copie du travail de recherche du postant dans sa base de données bibliographique tout en respectant le droit d'auteur.
                        </p>
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
        $('#dicipline').niceSelect();
        $('#typeService').niceSelect();
    </script>

    <script type="module" src="{{asset('clients/js-data/commande.js?'.Str::uuid())}}"></script>
    
    <script src="{{ asset('stdev/js/StdeUsefulFunction.js') }}"></script>


    <script>
        $("#theme").hide();
       new TomSelect("#theme",{
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>

    <script >


const chooseYes = document.getElementById('chooseYes');
const chooseNo = document.getElementById('chooseNo');
const divTheme = document.getElementById('div_theme');
const divSubject = document.getElementById('div_subject');

// Fonction pour afficher ou masquer les champs
function handleThemeSelection() {
    if (chooseYes.checked) {
        // Affiche la liste déroulante si "Oui" est sélectionné
        divTheme.style.display = 'block';
        divSubject.style.display = 'none';
    } else if (chooseNo.checked) {
        // Affiche le champ texte si "Non" est sélectionné
        divTheme.style.display = 'none';
        divSubject.style.display = 'block';
    }
}

// Ajouter des écouteurs d'événements sur les boutons radio
chooseYes.addEventListener('change', handleThemeSelection);
chooseNo.addEventListener('change', handleThemeSelection);
    // Intégration des codes promo valides dans une variable JavaScript
    const codesPromoValides = @json($codesPromoValides);
  
  document.addEventListener("DOMContentLoaded", () => {

    const needStageYes = document.getElementById('needStageYes');
        const needStageNo = document.getElementById('needStageNo');
        const stageDetails = document.getElementById('stageDetails');

        // Écoute les changements
        needStageYes.addEventListener('change', function () {
            if (needStageYes.checked) {
                stageDetails.style.display = 'block';
            }
        });

        needStageNo.addEventListener('change', function () {
            if (needStageNo.checked) {
                stageDetails.style.display = 'none';
            }
        });


  const steps = document.querySelectorAll(".step");
  let currentStep = 0;

  // Afficher l'étape actuelle
  const showStep = (index) => {
    steps.forEach((step, idx) => {
      step.classList.toggle("d-none", idx !== index);
    });
  };

  // Boutons "Suivant"
  document.querySelectorAll(".next-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      if (currentStep < steps.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    });
  });

  // Boutons "Précédent"
  document.querySelectorAll(".prev-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });
  });

  // Afficher la première étape au début
  showStep(currentStep);
});

window.onload = function () {
    // Fonction pour vérifier l'état des champs requis dans un step donné
    function checkFields(step) {
        var isValid = true;
        var requiredFields = step.querySelectorAll('input[required], select[required]'); // Sélectionner tous les champs requis

        // Vérifier tous les champs requis dans l'étape
        requiredFields.forEach(function (field) {
            if (field.type === 'radio' || field.type === 'checkbox') {
                // Vérifier si au moins une option radio ou case à cocher est sélectionnée
              
            } else if (field.type === 'text' || field.tagName === 'SELECT') {
                // Vérifier les champs texte et select
                if (field.value.trim() === '') {
                    isValid = false;
                }
            }
        });

        // Activer ou désactiver le bouton "Suivant"
        var nextBtn = step.querySelector('.next-btn');
        if (isValid) {
            nextBtn.disabled = false; // Si tous les champs sont remplis, activer le bouton
        } else {
            nextBtn.disabled = true; // Sinon, désactiver
        }
    }

    // Écouter les événements de changement sur tous les champs (inputs, selects, radio, etc.)
    document.querySelectorAll('input, select').forEach(function (input) {
        input.addEventListener('input', function () {
            // Vérifier l'étape actuelle à chaque changement
            var currentStep = input.closest('.step');
            checkFields(currentStep); // Vérifier l'étape courante
        });
    });

    // Cette fonction va vérifier le champ "thème" dans le step 2, à chaque fois qu'un champ change
    function checkThemeStep() {
        var themeFieldText = document.querySelector('#subject'); // Champ texte pour le thème
        var themeFieldSelect = document.querySelector('#theme'); // Champ select pour le thème
        var nextBtn = document.querySelector('.next-btn'); // Bouton suivant générique

        // Activer ou désactiver le bouton en fonction de la sélection du thème
        if ((themeFieldText && themeFieldText.value.trim() === '') && (themeFieldSelect && themeFieldSelect.value === '')) {
            nextBtn.disabled = true; // Désactiver si aucun thème n'est choisi
        } else {
            nextBtn.disabled = false; // Activer si un thème est choisi
        }
    }

    // Appeler cette fonction à chaque fois qu'un champ change dans le step 2
    document.querySelector('#subject').addEventListener('input', function () {
        checkThemeStep();
    });

    document.querySelector('#theme').addEventListener('change', function () {
        checkThemeStep();
    });

    // Vérifier les champs au chargement de la page (important pour initialiser les validations)
    document.querySelectorAll('.step').forEach(function (step) {
        checkFields(step); // Vérification de chaque étape
    });

    // Vérification des champs "thème" au chargement
    checkThemeStep(); // Vérifier si le thème est sélectionné dans le step 2 au départ
};

</script>

@endsection
