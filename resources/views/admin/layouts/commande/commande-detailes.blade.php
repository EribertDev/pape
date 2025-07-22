@extends('admin.master')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('stdev/css/badge-status.css')}}">
@endsection

@section('page-content')
    @php
    if (!empty($data)){
        $commande = $data["commande"];
        $redactors = !empty($data["redactors"])?$data["redactors"]:null;
    }
    @endphp
    <div class="content">
        <div class="container-fluid">
           <div class="row">
               <h4 class="page-title col-9" >Commandes: {{$commande["reference"]}}</h4>

               <div class="col-3">
                   <div class="d-grid d-md-none gap-2 d-flex justify-content-end ">
                       @if (strtolower($commande->status->name)==="en attente")
                           <a class="btn btn-success text-white btn-sm btn-floating accepter" data-mdb-ripple-init style="background-color:  #2eca7f;" href="#!" role="button" id="accepterBtn1">
                            <i class="fa-solid fa-share" style="transform: rotateY(180deg)"></i>
                            </a>
                            <a class="btn btn-danger text-white btn-sm btn-floating reject" data-mdb-ripple-init style="background-color: #55acee;" href="#!" role="button" id="rejectBtn1">
                                <i class="fa-solid fa-share" style="transform: rotateY(180deg)"></i>
                            </a>
                       @endif
                       <a class="btn text-white btn-sm btn-floating" data-mdb-ripple-init style="background-color: #55acee;" href="#!" role="button">
                           <i class="fa-solid fa-print"></i>
                       </a>
                   </div>

                   <div class="d-grid d-none d-md-block gap-2 d-md-flex justify-content-end">
                    @if (strtolower($commande->status->name)==="en attente")
                        <a class="btn btn-success text-white accepter" data-mdb-ripple-init style="background-color:   #2eca7f;" role="button" id="accepterBtn2">
                            <i class="fa-solid fa-share" style="transform: rotateY(180deg)"></i>
                            Accepter
                        </a>
                        <a class="btn btn-danger text-white reject" data-mdb-ripple-init style="background-color: #55acee;" role="button" id="rejectBtn2">
                            <i class="fa-solid fa-share" style="transform: rotateY(180deg)"></i>
                            Rejeter
                        </a>
                       @endif
                   
                       <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="#!" role="button">
                           <i class="fa-solid fa-print"></i>
                           Imprimer
                       </a>
                   </div>
               </div>
           </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                             <div class="row">
                                 @if (strtolower($commande->structure_stage)==="standard")
                                    <div class="col-5 text-end">
                                         <h4><span class="badge bg-secondary text-dark"><h4>Standard</span></h4>
                                    </div>
                                @elseif(strtolower($commande->structure_stage)==="vip")
                                    <div class="col-5 text-end">
                                        <h4><span class="badge bg-info text-white">Prenium</span></h4>
                                    </div>
                              
                                @endif
                             </div>
                            <div class="row"><h5 class="col-7 card-title text-start">Detail</h5>
                              
                                <div class="col-5 text-end" id="cmdStatus"></div>
                            <p class="card-text"><span class="fw-bold">Service : </span><span>{{$commande["service"]["name"]}}</span> </p>
                            <p class="card-text"><span class="fw-bold">Discipline : </span><span>{{$commande["discipline"]["name"]}}</span> </p>
                        {{--     <p class="card-text"><span class="fw-bold">Nombre : </span><span>{{$commande["max_pages"]}}</span> </p>--}}
                            <p class="card-text"><span class="fw-bold">Date limite : </span><span>{{$commande["deadline"]}}</span> </p>
                            <p class="card-text"><span class="fw-bold">Subject : </span><span>{{$commande["subject"]}}</span> </p>
                            <p class="card-text"><span class="fw-bold">Université : </span><span>{{$commande["universite"]}}</span> </p>
                            <p class="card-text"><span class="fw-bold">Pays:</span><span>{{$commande["pays"]}}</span> </p>
                            <p class="card-text"><span class="fw-bold">Année académique : </span><span>{{$commande["annee_academique"]}}</span> </p>
{{--                            <p class="card-text"><span class="fw-bold">Problème principal à résoudre : </span><span>{{$commande["description"]}}</span> </p>--}}

                            <p class="card-text"><span class="fw-bold">Fichier joint :  
                                @if(!empty($commande["filesPath"]))
                                    @foreach($commande["filesPath"] as $filePath)
                                    @if ($filePath["type"]===0)
                                        <span>{{$filePath["reference"]}} 
                                            <a class="btn-sm text-white mx-1 download-bd" data-mdb-ripple-init style="background-color: #2eca7f;"  href="{{ asset('storage/' . $filePath->path) }}" download="{{ basename($filePath->path) }}">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        </span>
                                    @endif
                                    @endforeach 
                                @endif
                            </p>
                           
                          
                            
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cilent N° : {{$commande["client"]["uuid"]}}</h5>
                            <p class="card-text"><span class="fw-bold">Nom : </span><span>{{$commande["client"]["last_name"].' '.$commande["client"]["fist_name"]}}</span> </p>
                            <p class="card-text"><span class="fw-bold">Contact : </span><span>{{$commande["client"]["phone_number"]}}</span> </p>
                            <p class="card-text"><span class="fw-bold">Email : </span><span>{{$commande["client"]["email"]}}</span> </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Payement</h5>
                            <h6 class="card-title fs-6">Montant à payer: {{$commande["amount"]}} (XOF) F cfa</h6>
                            <h6 class="card-title fs-6">
                                @php
                                  $amountPaid = collect($commande->payments)->where('status.id', '20')->sum('amount'); 
                               @endphp
                                Total payer:  {{ $amountPaid  }} (XOF) F cfa
                              
                            
                           
                          </h6>
                            <input type="text" value="{{$commande["uuid"]}}" name="cmdUuid" id="cmdUuid" hidden >

                           {{--  <form class="mt-" id="payementForm">
                                @csrf
                                    <input type="text" value="{{$commande["uuid"]}}" name="cmdUuid" id="cmdUuid" style="display: none">
                                    <div class="input-group form-outline my-3" data-mdb-input-init>
                                    <input type="text" id="priseContact" name="priseContact" class="form-control"  value="{{!empty($commande["payments"])?$commande["payments"][0]["amount"]:"3000"}}"/>
                                    <label class="form-label" for="priseContact">Prise de contact</label>
                                    <span class="input-group-text">F cfa (XOF)</span>
                                   @php
                                        if (!empty($commande["payments"])){
                                            if ($commande["payments"][0]["status_id"]===19){
                                                echo '<span class="input-group-text texte-success"><i class="fa-solid fa-check"></i></span>';
                                            }else{
                                                echo '<span class="input-group-text text-danger"><i class="fa-solid fa-xmark"></i></span>';
                                            }
                                        }
                                    @endphp

                                </div>
                                <div class="input-group form-outline my-3" data-mdb-input-init>
                                    <input type="text" id="tranche1" name="tranche1" class="form-control" value="{{!empty($commande["payments"])?$commande["payments"][1]["amount"]:""}}" />
                                    <label class="form-label" for="tranche1">Trache 1</label>
                                    <span class="input-group-text">F cfa (XOF)</span>
                                    @php
                                        if (!empty($commande["payments"])){
                                            if ($commande["payments"][0]["status_id"]===19){
                                                echo '<span class="input-group-text texte-success"><i class="fa-solid fa-check"></i></span>';
                                            }else{
                                                echo '<span class="input-group-text text-danger"><i class="fa-solid fa-xmark"></i></span>';
                                            }
                                        }
                                    @endphp
                                </div>

                                <div class="input-group form-outline my-3">
                                    <div class="input-group form-outline" data-mdb-input-init>
                                        <input type="text" class="form-control" id="tranche2" aria-describedby="inputTranche2" name="tranche2" value="{{!empty($commande["payments"])?$commande["payments"][2]["amount"]:""}}"/>
                                        <label for="tranche2" class="form-label">Trache 2</label>
                                        <span class="input-group-text" id="inputTranche2">F cfa (XOF)</span>
                                        @php
                                            if (!empty($commande["payments"])){
                                                if ($commande["payments"][0]["status_id"]===19){
                                                    echo '<span class="input-group-text texte-success"><i class="fa-solid fa-check"></i></span>';
                                                }else{
                                                    echo '<span class="input-group-text text-danger"><i class="fa-solid fa-xmark"></i></span>';
                                                }
                                            }
                                        @endphp
                                      
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button data-mdb-ripple-init="" type="button" class="btn btn-primary" id="btnApprouve"> <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true" hidden></span> {{!empty($commande["payments"])?"Modifier":"Approuvé"}}</button>
                                </div>
                            </form>--}}
                        </div>
                    </div>

                    @if(($commande["status"]["name"]))
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Rédacteur: {{!empty($commande["redactor"])?$commande["redactor"]["fist_name"]." ".$commande["redactor"]["last_name"]:"------"}}</h5>
                                <div class="form-group">
                                    <form id="redactorForm">
                                        @csrf
                                        <label for="squareSelect">Editeur</label>
                                        <select class="form-control input-square" id="redactorSelect" >
                                            @if(!empty($redactors))
                                                @foreach($redactors as $redactor)
                                                    <option value="{{$redactor->id}}">{{$redactor->fist_name." ".$redactor->last_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                            <button data-mdb-ripple-init="" type="submit" class="btn btn-primary" id="addRedactor"><span class="spinner-border spinner-border-sm" id="spinner-2" role="status" aria-hidden="true" hidden></span>{{$commande["status"]["name"]==="En traitement"?"Modifier":"Ajouter"}}</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                   
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fichier finale: 
                               
                                @if(!empty($commande["filesPath"]))
                                @foreach($commande["filesPath"] as $filePath)
                                @if ($filePath["type"]==1)
                                    <span>{{$filePath["reference"]}} 
                                        <a class="btn-sm text-white mx-1 download-bd" data-mdb-ripple-init style="background-color: #2eca7f;"  href="{{ asset('storage/' . $filePath->path) }}" download="{{ basename($filePath->path) }}">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    </span>
                                @endif
                                @endforeach 
                            @endif
                            </h5>
                            <div class="form-group">
                                <form id="ficheForm">
                                    @csrf

                                    <label for="type">Type</label>
                                    <select  class="form-control input-square" name="type" id="type">
                                        <option value="protocole">Protocole</option>
                                        <option value="complete">Rédaction Complete </option>
                                    </select>

                                    <input type="text" value="{{$commande["uuid"]}}" name="uuid" hidden >
                                    <label class="form-label" for="customFile">Ajouter un fichier(.pdf,.docx)</label>
                                    <input type="file" class="form-control" id="customFile" name="customFile" accept=".docx,.xlsx,.pdf" />
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                        <button data-mdb-ripple-init="" type="submit" class="btn btn-primary send" id="send" ><span class="spinner-border spinner-border-sm"  role="status" aria-hidden="true" hidden></span> Envoyer</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fiche Technique: 
                                @if(!empty($commande["filesPath"]))
                                @foreach($commande["filesPath"] as $filePath)
                                @if ($filePath["type"]==2)
                                    <span>{{$filePath["reference"]}} 
                                        <a class="btn-sm text-white mx-1 download-bd" data-mdb-ripple-init style="background-color: #2eca7f;"  href="{{ asset('storage/' . $filePath->path) }}" download="{{ basename($filePath->path) }}">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    </span>
                                @endif
                                @endforeach 
                            @endif
                               
                        
                            </h5>
                            <div class="form-group">
                                <form id="ficheTechnique">
                                    @csrf
                                    <input type="text" value="{{$commande["uuid"]}}" name="uuid" hidden >
                                    <label class="form-label" for="fiche_technique">Ajouter la fiche technique(.pdf,.docx)</label>
                                    <input type="file" class="form-control" id="fiche_technique" name="fiche_technique" accept=".docx,.xlsx,.pdf" />
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                        <button data-mdb-ripple-init="" type="submit" class="btn btn-primary sendFiche" id="sendFiche" ><span class="spinner-border spinner-border-sm"  role="status" aria-hidden="true" hidden></span> Envoyer</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    
    <script type="text/javascript">const _statusCmd = '{{$commande["status"]["name"]}}'</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="{{asset('admin/js-data/commande-detaille.js')}}"></script>
    
@endsection
