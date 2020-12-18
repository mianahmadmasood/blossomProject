<div class="modal fade myModal" id="checkout-modal" tabindex="-1" role="dialog" aria-labelledby="Full_mapTitle" aria-hidden="true">  
    <div class="modal-dialog">    
        <div class="modal-content">
            <button type="button" class="close text-right float-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>   
            <div class="modal-body">
                <div class="body-message">
                    <div id="signin" data-target-group="idForm">
                        <div class="mb-3">
                            <a  class="btn btn-block btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#Signin_modal" href="javascript:void(0)"> {{ __('localization.continue_signin')}}
                            </a>                     
                        </div>
                        <div class="mb-3">
                            <a href="{{route('checkout')}}" style="color: #FFFFFF;" class="btn btn-block btn-primary"> {{ __('localization.continue_guest')}}</a>
                        </div>
                        <div class="text-center mb-3">
                            <p class="text-muted">
                                {{ __("localization.dont't_have_account")}}
                                <a data-toggle="modal" data-dismiss="modal" data-target="#Signup_modal" href="javascript:void(0)"> {{ __('localization.signup')}}
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>    
    </div>  
</div>	