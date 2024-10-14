@extends('clients.master-1')
@section('extra-style')
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}" />
    <link rel="stylesheet" href="{{asset('clients/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('clients/js-simple-loader-main/loader.js')}}"  ></script>
@endsection

@section('page-content')
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Contact</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>

    <section class="address_area section-padding">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
                    <div class="single_address">
                        <i class="ti-map"></i>
                        <h4>Location</h4>
                        <p>Bénin, Calavi</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single_address sabr">
                        <i class="ti-mobile"></i>
                        <h4>Téléphone</h4>
                        <p>+229 62 43 59 29</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single_address">
                        <i class="ti-email"></i>
                        <h4>Email</h4>
                        <p>pape@cesiebenin.com</p>

                    </div>
                </div><!-- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <div id="contact" class="contact_area section-padding">
        <div class="container">
            <div class="section-title-two">
                <h2>Envoyer nous un mail.</h2>
            </div>
            <div class="row">
                <div class="offset-lg-1 col-lg-10 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="contact">
                        <form class="form" name="enq" method="post" action="https://wphtml.com/html/tf/penn/contact.php" onsubmit="return validation();">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Nom et Prénoms (*)</label>
                                    <input type="text" name="name" class="form-control" required="required">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Email (*)</label>
                                    <input type="email" name="email" class="form-control" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Sujet (*)</label>
                                    <input type="text" name="subject" class="form-control" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Message (*)</label>
                                    <textarea rows="6" name="message" class="form-control" required="required"></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" value="Send message" name="submit" id="submitButton" class="btn_one" title="Submit Your Message!">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- END COL  -->
            </div><!-- END ROW -->
        </div><!--- END CONTAINER -->
    </div>
@endsection

@section('extra-scripts')

@endsection
