<div>
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-rdm"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Start Navbar Links-->
            <ul class="navbar-nav">
                <li class="nav-item"> <a class="nav-link text-white" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i> </a> </li>
                <li class="nav-item d-none d-md-block"> <a wire:navigate href="/adminpanel"
                        class="nav-link text-white">Dashboard</a> </li>
            </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i
                            data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize"
                            class="bi bi-fullscreen-exit" style="display: none;"></i>
                    </a> </li>
                    <li class="nav-item"> @livewire('admin.components.logout') </li>

            </ul> <!--end::End Navbar Links-->
        </div> <!--end::Container-->
    </nav> <!--end::Header-->
</div>
