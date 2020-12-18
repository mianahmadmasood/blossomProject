<div class="modal fade myModal" id="Signin_modal" tabindex="-1" role="dialog" aria-labelledby="Full_mapTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close text-right float-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-body">

                <div id="signin_alert" class="alert alert-danger alert-dismissible dn" >
                     <span id="signin_message">Please enter a valid value in all the required fields before proceeding. </span>
                </div>

                <div class="body-message">

                    <!--                    <form class="js-validate" >-->
                    <!-- Signin -->
                    <div id="signin" data-target-group="idForm">
                        <!-- Title -->
                        <header class="text-center mb-5">
                            <h2 class="h4 mb-0"> {{ __('localization.please_signin')}}</h2>
                            <p>{{ __('localization.signin_desc')}}</p>
                        </header>

                        <!-- End Title -->

                        <!-- Input -->
                        <div class="js-form-message mb-3">
                            <div class="js-focus-state input-group form">
                                <div class="input-group-prepend form__prepend">
                                    <span class="input-group-text form__text">
                                        <span class="fa fa-user form__text-inner"></span>
                                    </span>
                                </div>
                                <input  maxlength="49" id="email1" type="email" class="form-control form__input" name="email" placeholder=" {{ __('localization.email')}}">
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Input -->
                        <div class="js-form-message mb-3">
                            <div class="js-focus-state input-group form">
                                <div class="input-group-prepend form__prepend">
                                    <span class="input-group-text form__text">
                                        <span class="fa fa-lock form__text-inner"></span>
                                    </span>
                                </div>
                                <input id="password_field" type="password" class="form-control form__input" name="password"  placeholder="{{ __('localization.password')}}">
                                <input id="device_type" type="hidden" name="device_type" value="web">
                                <input id="device_token" type="hidden" name="device_token" value="0">
                            </div>
                        </div>
                        <!-- End Input -->

                        <div class="row mb-3">

                            <div class="col-6"></div>
                            <div class="col-6 text-right">
                                <a data-toggle="modal" data-dismiss="modal" data-target="#forgot_modal" href="javascript:void(0)"> {{ __('localization.forgot_password')}}</a>

                            </div>
                        </div>

                        <div class="mb-3">
                            <button id="signin-btn" type="submit" class="btn btn-block btn-primary">
                                <i id="l_loader_button" class="dn"><img src="{{asset('/public/images/ajax-loader.gif')}}" alt=""/> </i>
                                {{ __('localization.sign_in')}}
                            </button>
                        </div>

                        <div class="text-center mb-3">
                            <p class="text-muted">
                                {{ __("localization.dont't_have_account")}}
                                <a data-toggle="modal" data-dismiss="modal" class="modaldev modalDevSignUp" data-target="#Signup_modal" href="javascript:void(0)">{{ __('localization.signup')}}
                                </a>
                            </p>
                        </div>

                    </div>
                    <!-- End Signin -->
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>

</div>

