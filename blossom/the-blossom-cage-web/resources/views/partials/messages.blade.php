@if(Session::has('success_message'))
<div id="alert"  class="alert alert-success @if(Route::current()->getName()  !=  'checkout') altermassageDev @endif">
    {{session::get('success_message')}}
</div>
@endif
@if(Session::has('error_message'))
<div id="alert"  class="alert alert-danger @if(Route::current()->getName()  !=  'checkout') altermassageDev @endif">
    {{session::get('error_message')}}
</div>
@endif
@if(Session::has('warning_message'))
<div id="alert" class="alert alert-warning @if(Route::current()->getName()  !=  'checkout') altermassageDev @endif">
    {{session::get('warning_message')}}
</div>
@endif
