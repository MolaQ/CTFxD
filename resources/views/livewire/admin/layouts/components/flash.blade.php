@if (session()->has('success'))
<div class="flash-message alert alert-success" style="opacity: 1;">
    {{ session('success') }}
</div>
@endif

@if (session()->has('danger'))
<div class="flash-message alert alert-danger">
    {{ session('danger') }}
</div>
@endif