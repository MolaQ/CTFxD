@if (session()->has('success'))
    <div class="flash-message alert alert-success rounded mx-2 my-1">
        <strong>Yep!</strong> {{ session('success') }}
    </div>
@endif

@if (session()->has('danger'))
    <div class="flash-message alert alert-danger rounded mx-2 my-1">
        <strong>Whooops!</strong> {{ session('danger') }}
    </div>
@endif
