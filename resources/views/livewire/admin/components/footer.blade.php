
    <footer class="app-footer bg-rdm text-white"> <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">{{ $message }}</div> <!--end::To the end-->
        <p>This page took {{ round(microtime(true) - LARAVEL_START, 3) }} seconds to render</p>
    </footer> <!--end::Footer-->
