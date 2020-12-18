<div class="modal fade myModal" id="Signup_modal" tabindex="-1" role="dialog" aria-labelledby="Full_mapTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close text-right float-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-body">
                <div id="signup_alert_message" class="alert alert-danger alert-dismissible dn" >
                     <span id="signup_alert_message">Please enter a valid value in all the required fields before proceeding. </span>
                </div>
                <div class="body-message">
                    <!--<form class="js-validate">-->
                    <!-- Signup -->
                    <div id="signup" data-target-group="idForm">
                        <!-- Title -->
                        <header class="text-center mb-5">
                            <h2 class="h4 mb-0">{{ __('localization.please_signup')}} </h2>
                            <p>{{ __('localization.signup_desc')}}</p>
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
                                <input maxlength="25" id="first_name" type="text" class="form-control form__input" name="first_name" required placeholder="{{ __('localization.first_name')}}">
                            </div>
                        </div>
                        <!-- End Input -->
                        <!-- Input -->
                        <div class="js-form-message mb-3">
                            <div class="js-focus-state input-group form">
                                <div class="input-group-prepend form__prepend">
                                    <span class="input-group-text form__text">
                                        <span class="fa fa-user form__text-inner"></span>
                                    </span>
                                </div>
                                <input  maxlength="25"  id="last_name" type="text" class="form-control form__input" name="last_name" required placeholder="{{ __('localization.last_name')}}">
                            </div>
                        </div>
                        <!-- End Input -->
                        <!-- Input -->
                        <div class="js-form-message mb-3">
                            <div class="js-focus-state input-group form">
                                <div class="input-group-prepend form__prepend">
                                    <span class="input-group-text form__text">
                                        <span class="fa fa-user form__text-inner"></span>
                                    </span>
                                </div>
                                <input  maxlength="49"  id="email-signup" type="email" class="form-control form__input" name="email" required placeholder="{{ __('localization.email')}}">
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
                                <input id="device_type" type="hidden" name="device_type" value="web">
                                <input id="device_token" type="hidden" name="device_token" value="0">
                                <input id="password_field1" type="password" class="form-control form__input" name="password" id="password" placeholder="{{ __('localization.password')}}" required>
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Input -->
                        <div class="js-form-message mb-3">
                            <div class="js-focus-state input-group form">
                                <div class="input-group-prepend form__prepend">
                                    <span class="input-group-text form__text">
                                        <span class="fa fa-key form__text-inner"></span>
                                    </span>
                                </div>
                                <input  maxlength="255"  id="confirm-password-field"  type="password" class="form-control form__input" name="confirmPassword" required placeholder="{{ __('localization.confirm_password')}}">
                            </div>
                        </div>
                        <!-- End Input -->

                        <div class="mb-3">
                            <button  id="signup-btn" type="submit" class="btn btn-block btn-primary">
                                <i id="s_loader_button" class="dn"><img src="{{asset('/public/images/ajax-loader.gif')}}" alt=""/> </i>
                                {{ __('localization.signup')}}
                            </button>
                        </div>

                        <div class="text-center mb-3">
                            <p class="text-muted">
                                {{ __('localization.have_account')}}
                                <a data-toggle="modal" data-dismiss="modal"  class="modaldev modalDevSignUp" data-target="#Signin_modal" href="javascript:void(0)">{{ __('localization.sign_in')}}</a>
                            </p>
                        </div>
                    </div>
                    <!-- End Signup -->

                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>
</div>
