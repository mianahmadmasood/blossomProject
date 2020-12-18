<div class="modal fade myModal" id="forgot_modal" tabindex="-1" role="dialog" aria-labelledby="Full_mapTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close text-right float-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-body">
                <div class="body-message">
                    <div id="signup_alert" class="alert alert-danger alert-dismissible fade show dn" >
                         <span id="signup_message">Please enter a valid value in all the required fields before proceeding. </span>
                    </div>
                    <!-- Forgot Password -->
                    <div class="w100">
                        <!-- Title -->
                        <header class="text-center mb-5">
                            <h2 class="h4 mb-0"> {{ __('localization.recover_account')}} </h2>
                            <p> {{ __('localization.recover_desc')}}</p>
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
                                <input id="email" type="email" class="form-control form__input" name="email" placeholder=" {{ __('localization.email')}}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button id="sub_f_pass" type="submit" class="btn btn-block btn-primary">
                                <i id="f_loader_button" class="dn"><img src="{{asset('/public/images/ajax-loader.gif')}}" alt=""/> </i>
                                {{ __('localization.recover_account')}}</button>
                        </div>

                        <div class="text-center mb-3">
                            <p class="text-muted">
                                {{ __('localization.have_account')}}
                                <a data-toggle="modal" data-dismiss="modal" data-target="#Signin_modal" href="javascript:void(0)">{{ __('localization.sign_in')}}</a>
                            </p>
                        </div>
                    </div>
                    <!-- End Forgot Password -->
                </div>
            </div>
        </div>
    </div>
</div>
