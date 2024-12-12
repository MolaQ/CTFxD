    <nav class="navbar fixed-bottom bg-rdm text-light">
        <div class="container-fluid">
            <div> MolaQ &#169;</div>
            <div> Load time {{ round(microtime(true) - LARAVEL_START, 3) }}</div>
            <div class="float-end d-none d-sm-inline">{{ $message }}</div>
        </div>
    </nav>
