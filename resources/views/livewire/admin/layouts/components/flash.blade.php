
@if (session()->has('success'))
<div class="alert alert-success mx-2" role="alert">
<strong>Good job!</strong> {{session('success')}}
</div>
@endif

@if (session()->has('danger'))
<div class="alert alert-danger mx-2" role="alert">
    <strong>Whoops!</strong> {{session('danger')}}
</div>
@endif

<div class="toastrMsg">
    @if (session()->has('success'))
    <div id="successMessage" class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="fa fa-times mr-1"></i>
        {{ session('message') }}
    </div>
    @endif
</div>