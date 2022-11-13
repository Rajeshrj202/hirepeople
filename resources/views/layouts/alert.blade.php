@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ Session::get('success') }}
</div>
@elseif(Request::has('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ Request::get('success') }}
</div>
@endif

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible fade show">
    {{ Session::get('message') }}
</div>
@elseif(Request::has('message'))
<div class="alert alert-success alert-dismissible fade show">
    {{ Request::get('message') }}
</div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning alert-dismissible fade show">
    {{ Session::get('warning') }}
</div>
@elseif(Request::has('warning'))
<div class="alert alert-warning alert-dismissible fade show">
    {{ Request::get('warning') }}
</div>
@endif


@if(Session::has('alert'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ Session::get('alert') }}
</div>
@elseif(Request::has('alert'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ Request::get('alert') }}
</div>
@endif