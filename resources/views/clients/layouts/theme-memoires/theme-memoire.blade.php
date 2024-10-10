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
    @php
        $tms =  $data["tms"];
        $ctg = $data["ctg"];
    @endphp
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10  offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight col-12" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Bibliothèque</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
   @if(!empty($tms))
       <section id="product_area" class="section-padding">
           <div class="container">
               <div class="text-center">
                   <div class="home_sb mb-5 ">
                       <form action="#" class="banner_subs">
                           <input type="text" class="form-control home_si" placeholder="Recherche..." required="required">
                           {{-- <button type="button" class="subscribe__btn">Search <i class="fa fa-paper-plane-o"></i></button>--}}
                       </form>
                   </div>
                   <div class="product_filter">
                       <ul>
                          <li class="filter active" data-filter="all">All</li>
                           @if(!empty($ctg))
                               @foreach($ctg as $cat)
                                   <li class="filter mb-2" data-filter=".{{$cat->name}}">{{$cat->name}}</li>
                               @endforeach
                           @endif
                       </ul>
                   </div>
               </div>
           </div>
           <div class="row justify-content-center">
               <div class="col-lg-12 col-sm-12 col-xs-12">
                   <div class="accordion px-3" id="accordionExample">
                       @foreach($tms as $tm)
                           <div class="accordion-item">
                               <h2 class="accordion-header" id="{{'heading'.$tm->uuid}}">
                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                           data-bs-target="{{'#collapse'.$tm->uuid}}" aria-expanded="false" aria-controls="{{'collapse'.$tm->uuid}}">
                                       {{$tm->title}}
                                   </button>
                               </h2>
                               <div id="{{'collapse'.$tm->uuid}}" class="accordion-collapse collapse" aria-labelledby="{{'heading'.$tm->uuid}}"
                                    data-bs-parent="#accordionExample">
                                   <div class="accordion-body">
                                      {{$tm->description}}
                                   </div>
                               </div>
                           </div>
                       @endforeach
                   </div>
               </div><!-- END COL  -->
           </div><!--END  ROW  -->
       </section>
   @else
       <h2>Vide</h2>
   @endif
@endsection

@section('extra-scripts')

@endsection
