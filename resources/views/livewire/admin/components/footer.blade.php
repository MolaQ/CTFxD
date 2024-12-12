<footer class="app-footer bg-rdm text-white"> <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">{{ $message }}</div> <!--end::To the end-->
    <div>Render time: {{ round(microtime(true) - LARAVEL_START, 3) }}</div>
</footer> <!--end::Footer-->
