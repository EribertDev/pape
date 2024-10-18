
<div class="modal fade" id="loginModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="d-none d-md-block col-md-6 pt-5 pb-5">
                        <img src="{{asset('clients/assets/images/icon/logo-syrram.png')}}" class="img-fluid pt-5 pb-5">
                    </div>
                    <div class="login col-12 col-md-6 border border-0 shadow-">
                        <h4 class="login_register_title">Connexion</h4>
                        <div  role="alert" id="alertErrorId" >

                        </div>
                        <form id="loginForm">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" class=" form-control requiredField input-label" name="email">
                            </div>
                            <div class="form-group ">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control requiredField input-label" name="password">
                                <p class="text-end mb-2"> <a href="{{ route('reset.password') }}" type="button" >Mot de passe oublié?</a></p>
                            </div>

                            <div class="form-group col-lg-12">
                                <button class="btn_one" type="submit" name="submit" id="submitLoginBtnId"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden id="spinner-1"></span>  <span>Connexion</span></button>
                            </div>
                        </form>
                        <p>Vous n'avez pas un compte ? <a href="#" type="button" id="registerBtnId">Créer un compte</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


