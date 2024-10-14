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
                                            <div class="form-group my-3">
                                                <label for="cars">Type de service</label>
                                                <select  name="typeService" id="typeService">
                                                  
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
                                                <label for="cars">Discipline</label>
                                                <select  name="dicipline" id="dicipline">
                                                   @if (!empty($options['discipline']))
                                                   @php
                                                        foreach ($options['discipline'] as $datas){
                                                             echo '<option value="'.$datas->reference.'">'.$datas->name.'</option>';
                                                         }
                                                    @endphp
                                                   @endif
                                                </select>
                                            </div>
                                            {{--<div class="form-group my-3 ">
                                                <label for="cars">Niveau académique</label>
                                                <select  name="academicLevel" id="academicLevel">
                                                   @if (!empty($options['academicLevel']))
                                                        @php
                                                            foreach ($options['academicLevel'] as $datas){
                                                                echo '<option value="'.$datas->reference.'">'.$datas->name.'</option>';
                                                            }
                                                        @endphp
                                                   @endif
                                                </select>
                                            </div>--}}
                                        </div>
                                        <div class="col-12">
                                            <div class="col-12">
                                            <div class="form-group create-account">
                                                <input  type="checkbox" id="check_choose" value="1" name="choose_theme" checked>
                                                <label for="check_choose">Chosire un theme</label>
                                            </div>
                                        </div>
                                           
                                            <!-- <div class="form-check form-check-inline mt-lg-5" >
                                                <input class="form-check-input" type="checkbox" id="check_choose" value="1" name="choose_theme" checked>
                                                <label class="form-check-label" for="check_choose">Chosire un theme</label>
                                            </div> -->

                                            <div class="form-group mt-2" id="div_subject">
                                                <label class="fieldlabels" for="subject">Sujet</label>
                                                <input  class="px-2 py-2" type="text" name="subject" id="subject" placeholder="" />
                                            </div>

                                            <div class="form-group mt-2">
                                                <input  class="px-2 py-2" type="text" name="amount" id="amount" placeholder="" hidden/>
                                            </div>
                                                           
                                            <div class="form-group mt-2" id="div_theme">
                                                <label for="cars">Theme Mémoires</label>
                                                <select name="theme" id="theme" hidden>
                                                    <option value="">Select a state...</option>
                                                    @if (!empty($options['TMs']))
                                                        @php
                                                            foreach ($options['TMs'] as $datas){
                                                                //$discip = $datas->discipline;
                                                               // data-discipline="'.$discip->name.'"
                                                                echo '<option value="'.$datas->uuid.'" >'.$datas->title.'</option>';
                                                            
                                                            }
                                                        @endphp 
                                                    @endif
                                                </select>
                                            </div>
                        
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label class="fieldlabels" for="nbrPage" >Nombre de pages</label>
                                                    <input type="number" name="nbrPage" id="nbrPage" class="no-spinner">
                                                </div>
                                                <div class="form-group col-6">
                                                @php
                                                   // echo $dateLimit = $options['date'];
                                                @endphp
                                                    <label class="fieldlabels">Date limite</label>
                                                    <input  class="px-2 py-2" type="date" name="deadline" id="deadline" placeholder="" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group ">
                                        <label for="descrip_file">Ajouter un fichier (.pdf, .doc, .docx)</label>
                                        <input
                                        type="file"
                                        id="descrip_file"
                                        name="descrip_file"
                                        accept=".pdf, .doc, .docx"
                                        multiple />
                                    </div>               
                                        <div class="form-group">
                                            <label class="fieldlabels" for="description">Description</label>
                                            <textarea placeholder="Message" name="description" id="description" class="form-control mb-3" style="height: 150px;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="fieldlabels" for="nbrPage" >Code affiliation (Ex : AF85XX77)</label>
                                            <input type="text" name="codeAf" id="codeAf" class="no-spinner">
                                        </div> 
                                        <!-- <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="document">Fichier </label>
                                                <div class="needsclick dropzone" id="document-dropzone">

                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Button Widget -->
                               
                                <!--/ End Button Widget -->
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
						<div class="order-details">
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>Détails</h2>
								<div class="content">
									<ul>
                                        <li>Montant<span id="montant">-----</span></li>
										<li class="last"><span></span></li>
									</ul>
								</div>
							</div>
							
							<!-- <div class="single-widget payement">
								<div class="content">
									<img src="assets/img/payment-method.html" class="img-fluid" alt="#">
								</div>
							</div> -->
							<!--/ End Payment Method Widget -->
							<!-- Button Widget -->
							<div class="single-widget get-button">
								<div class="content">
									<div class="button">
										<a  id="commanderBtn" type="button" class="btn">  Envoyer</a>
									</div>
								</div>
							</div>
                            <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn_one btn btn-primary me-md-2 border-0" id="commanderBtn" type="button">
                                        Commander</button>
                                </div> -->
							<!--/ End Button Widget -->
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
                    <h5 class="modal-title fw-bold" id="scrollableModalLabel">Condition d'utilisation et de vente</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h3>Cher client,</h3>
                        <p>Nous vous remercions d'avoir choisi SyRRaM pour la rédaction de votre mémoire ou thèse. Nous souhaitons toutefois vous informer de certaines conditions d'utilisation de nos services :</p>
                        <ul>
                            <li>🔒 <strong>Confidentialité :</strong> Chez SyRRaM, nous nous engageons à garder confidentielles vos informations personnelles et ne les diffuserons qu'avec votre autorisation écrite.</li>
                            <li>✍️ <strong>Auteur :</strong> En vous inscrivant au PAPE vous devenez l'auteur exclusif de votre travail</li>
                            <li>💰 <strong>Paiement :</strong> Vous êtes tenu de régler les frais de prise de contact avant le démarrage du coaching par nos service compétents.</li>
                            <li>⚠️ <strong>Avertissement :</strong> En cas de non-règlement de la totalité des frais de d'inscription, vous perdrez vos droits d'auteur sur votre travail de recherche.</li>
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
        $('#dicipline').niceSelect();
        $('#typeService').niceSelect();
       
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> --}}
    <script type="module" src="{{asset('clients/js-data/commande.js?'.Str::uuid())}}">
    </script>
    <!-- <script>
        Loader.close()
        //dropezone confiq
        let uploadedDocumentMap = {};
        Dropzone.options.documentDropzone = {
            url:'{{route('files.store.temp')}}',
            maxFilesize: 4, // MB
            addRemoveLinks: true,
            maxFiles:3,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                uploadedDocumentMap[file.name] = response.name
                console.log(uploadedDocumentMap);
            },
            removedfile: function (file) {
                var name = file.file_name || uploadedDocumentMap[file.name];
                console.log('name:',JSON.stringify({ name: name }));
                $.ajax({
                    headers: {
                        'Accept': 'application/json;charset=utf-8',
                        'X-CSRF-TOKEN':"{{ csrf_token() }}"
                    },
                    url: '{{route('files.delete.temp')}}',
                    type:'POST',
                    data: { name: name,tt:"mama" },
                    dataType: 'JSON',
                    success: function (response) {
                        console.log(response);
                        file.previewElement.remove()
                        if (typeof file.file_name !== 'undefined') {
                            name = file.file_name
                        } else {
                            name = uploadedDocumentMap[file.name]
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                    },
                    complete: function () {
                    }
                });
            },
            init: function () {
            }
        };
    </script> -->

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
    
@endsection
