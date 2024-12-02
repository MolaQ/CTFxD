        <!--begin::Sidebar-->

        <aside class="app-sidebar bg-rdm-dark shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
            <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="/" wire:navigate class="brand-link">
                    <!--begin::Brand Image--> <img src="{{ asset('img/CTFxD.png') }}" alt="CTFxD"
                        class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
                        class="brand-text fw-light">{{ config('app.name') }}</span> <!--end::Brand Text--> </a>
                <!--end::Brand Link-->
            </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/adminpanel" wire:navigate class="nav-link"> <i
                                    class="nav-icon bi bi-speedometer"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/adminpanel/users" wire:navigate class="nav-link"> <i
                                    class="nav-icon bi bi-people"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/adminpanel/schools" wire:navigate class="nav-link"> <i
                                    class="nav-icon bi bi-buildings"></i>
                                <p>Schools</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/adminpanel/teams" wire:navigate class="nav-link"> <i
                                    class="nav-icon bi bi-incognito"></i>
                                <p>Teams</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/adminpanel/contests" wire:navigate class="nav-link"> <i
                                    class="nav-icon bi bi-card-text"></i>
                                <p>Contests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/adminpanel/tasks" wire:navigate class="nav-link"> <i
                                    class="nav-icon bi bi-card-list"></i>
                                <p>Tasks</p>
                            </a>
                        </li>
                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar-->
