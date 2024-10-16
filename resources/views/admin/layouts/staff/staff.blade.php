@extends('admin.master')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('stdev/css/badge-status.css')}}">
@endsection

@section('page-content')
    <div class="content">
        <div class="container-fluid">
            <div class="row px-1">
                <h4 class="page-title col-10" >Equipe</h4>
                <div class="col-2 ps-auto">
                    <div class="d-grid d-md-none gap-2 d-md-flex justify-content-md-end">
                        <a class="btn text-white btn-sm btn-floating" data-mdb-ripple-init style="background-color: #55acee;" data-mdb-modal-init data-mdb-target="#memberModale"  role="button"  >
                            <i class="fa-solid fa-add"></i>
                        </a>
                    </div>
                    <div class="d-grid d-none d-md-block gap-2 d-md-flex justify-content-md-end">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;"  role="button" data-mdb-modal-init data-mdb-target="#memberModale">
                            <i class="fa-solid fa-add"></i>
                            Ajouter
                        </a>
                    </div>
                </div>

            </div>
            <div class="row">
               @if(!empty($membres=$data["membres"]))
                   @foreach($membres as $membre)
                        <div class="col-xl-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <p style="
                                             background-color:rgba(182,13,130,0.89);
                                             width: 50px ;
                                             height: 50px;
                                             border-radius: 50px;
                                             text-align: center;
                                             color: white;
                                             font-weight: bold;
                                             font-size: 1.2rem;
                                             display: flex;
                                             justify-content: center;
                                             align-items: center;
                                             box-shadow: -19px 28px 61px 3px rgba(217,217,217,0.72);
                                                -webkit-box-shadow: -19px 28px 61px 3px rgba(217,217,217,0.72);
                                                -moz-box-shadow: -19px 28px 61px 3px rgba(217,217,217,0.72);

                                           ">{{get_string_initial($membre->fist_name ." ".$membre->last_name,2)}}</p>
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1">{{$membre->fist_name ." ".$membre->last_name}}</p>
                                                <p class="text-muted mb-0">{{!empty($membre->user->email)?$membre->user->email:""}}</p>
                                                <p class="text-muted mb-0">{{!empty($membre->user->role)?$membre->user->role->name:""}}</p>
                                            </div>
                                        </div>
                                        <span class="badge rounded-pill badge-success" >{{$membre->status->name}}</span>
                                    </div>
                                </div>
                                <div
                                    class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around"
                                >
                                    <a
                                        class="btn btn-link m-0 text-reset email"
                                        href="#"
                                        role="button"
                                        data-ripple-color="primary"
                                        data-mdb-ripple-init
                                        data-email = "{{!empty($membre->user->email)?$membre->user->email:""}}"
                                    >Message<i class="fas fa-envelope ms-2"></i
                                        ></a>
                                    <div class="btn-group shadow-0 mb-2">
                                        <button
                                            class="btn btn-secondary dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton"
                                            data-mdb-dropdown-init
                                            data-mdb-ripple-init
                                            aria-expanded="false"
                                        >
                                            Action
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="#" data-reference="{{$membre->reference}}" data-action="detail">Détail</a></li>
                                            {{-- <li><a class="dropdown-item" href="#" data-reference="{{$membre->reference}}" data-action="locked">Bloqué</a></li>
                                            <li><a class="dropdown-item" href="#" data-reference="{{$membre->reference}}" data-action="delete">Supprimé</a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                   @endforeach
                       <div>
                           {{ $membres->links('pagination::bootstrap-5') }}
                       </div>
               @endif

            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')

    <div class="modal fade" id="memberModale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau membre</h5>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="memberForm">
                        @csrf
                        <div class="row">
                            <div class="mb-1 col-12 col-md-6">
                                <label for="lastName" class="col-form-label" id="last_name" >Nom</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" />
                            </div>
                            <div class="mb-1 col-12 col-md-6">
                                <label for="firstName" class="col-form-label" >Prénoms</label>
                                <input type="text" class="form-control" id="firstName" name="firstName"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-1 col-12 col-md-6">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"/>
                            </div>
                            <div class="mb-1 col-12 col-md-6">
                                <label for="phoneNumber" class="col-form-label">Téléphone</label>
                                <input type="number" class="form-control" id="phoneNumber" name="phoneNumber"  />
                            </div>
                        </div>
                       <div class="row">
                           <div class="mb-1 col-12 ">
                               <label for="role" class="col-form-label">Role</label>
                               <select class="form-control " id="role" name="role" >
                                  @if(!empty($roles=$data["roles"]))
                                      @foreach($roles as $role)
                                           <option value="{{$role->id}}">{{$role->name}}</option>
                                      @endforeach
                                  @endif
                               </select>
                           </div>
                       </div>
                        <div class="mb-1">
                            <label for="password" class="col-form-label">Mot de passe</label>
                            <input type="text" class="form-control" id="password" name="password"  />
                        </div>
                        <div class="mb-1" id="codeaf-div">
                            <label for="codeaf" class="col-form-label">Code affiliation</label>
                            <input type="text" class="form-control" id="codeaf" name="codeaf"  />
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="col-form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio"></textarea>
                        </div>
                        <input type="text" hidden class="form-control" id="id_admin" name="id_admin"/>
                        <input type="text" hidden class="form-control" id="id_user" name="id_user"/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Annulé</button>
                            <button type="button" class="btn btn-primary" data-mdb-ripple-init id="memberFormSubmit"><span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" hidden ></span>Ajouter
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script type="module" src="{{asset('admin/js-data/staff.js')}}"></script>

@endsection
