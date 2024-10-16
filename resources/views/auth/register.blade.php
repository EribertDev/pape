
<div class="modal fade" id="registerModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="d-none d-md-block col-md-6">
                        <img src="{{asset('clients/assets/images/all-img/become-ins.png')}}" class="img-fluid">
                    </div>

                    <div class="register col-12 col-md-6 border border-0">
                        <form id="registerForm">
                            @csrf
                            <h4 class="login_register_title">Créer un compte</h4>
                            <div id="alert">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Nom <span class="text-danger">*</span> </label>
                                <input type="text" id="last_name" class=" form-control requiredField input-label" name="last_name">
                            </div>
                            <div class="form-group">
                                <label for="fist_name">Prénoms <span class="text-danger">*</span> </label>
                                <input type="text" id="fist_name" class=" form-control requiredField input-label" name="fist_name">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label for="_email">Email <span class="text-danger">*</span> </label>
                                    <input type="email" id="_email" class="form-control requiredField input-label" name="_email">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="phone_number">Téléphone<span class="text-danger">*</span> (whatsapp)</label>
                                    <input type="tel" id="phone_number" class="form-control requiredField input-label" name="phone_number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="_password">Mot de passe <span class="text-danger">*</span>
                                    <span class="text-small" style="font-size:11px"> (le mot de passe doit contenir au moins 8 caractères)</span>
                                    </label>
                                    <input type="password" id="_password" class="form-control requiredField input-label" name="_password">
                                </div>
                               {{-- <div class="form-group col-12 col-md-6">
                                    <label for="confirmedPwd">Confirmer</label>
                                    <input type="password" id="confirmedPwd" class="form-control requiredField input-label" name="confirmedPwd">
                                </div>--}}
                            </div>
                            <div class="form-group col-lg-12">
                            <button type="button" class="btn_one  btn btn-primary border-0" id="submitRegisterBtnId"><span class="spinner-border spinner-border-sm" aria-hidden="true" id="spnBtnId" hidden></span><span>Créer un compte</span></button>

                                {{-- <button class="btn_one " type="button"  id="submitRegisterBtnId">
                                    <span class="spinner-border spinner-border-sm spinner me-2"  id="spnBtnId" hidden></span> <span role="status">Créer un compte</span>
                                </button> --}}
                            </div>
                        </form>
                        <p>Vous avez déjà un compte ? <a href="#" id="loginBtnId">Connexion</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


