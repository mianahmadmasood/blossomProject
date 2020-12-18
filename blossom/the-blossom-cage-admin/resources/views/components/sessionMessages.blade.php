@if(Session::has('success_message'))
<div class="alert alert-success" role="alert">
    <div class="alert-text"> {{session::get('success_message')}}</div>
</div>

@endif

@if(Session::has('error_message'))
<div class="alert alert-danger" role="alert">
    <div class="alert-text">{{session::get('error_message')}}</div>
</div>
@endif

@if(Session::get('errors'))
<div class="alert alert-danger" role="alert">
    <div class="alert-text"> {{Session::get('errors')->first()}}</div>
</div>
@endif