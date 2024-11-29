            <main class="app-main"> <!--begin::App Content Header-->
                <div class="app-content-header"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">{{ $title ?? 'Page Title' }}</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a wire:navigate href="/adminpanel">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $title ?? 'Page Title' }}
                                    </li>
                                </ol>
                            </div>
                        </div> <!--end::Row-->
                    </div> <!--end::Container-->
                </div> <!--end::App Content Header--> <!--begin::App Content-->
                <div class="app-content"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-12"> <!-- Default box -->
                                {{-- Flash messages --}}
                                @include('livewire.admin.layouts.components.flash')

                                <div class="card">
                                    <div class="card-header">


                                        <div class="d-flex justify-content-between mb-1 pt-1">
                                            <!-- Lewa strona: Przycisk -->
                                            <button class="btn btn-rdm text-white">
                                                <i class="bi bi-plus"></i> ADD TEAM
                                            </button>

                                            <!-- Prawa strona: Pole wyszukiwania -->
                                            <div class="col-3">
                                                <input wire:model.live="search" id="search"
                                                    class="form-control border-rdm shadow-none"
                                                    placeholder="Szukaj Zespołu">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%">#</th>
                                                    <th>Team name</th>
                                                    <th>Members</th>
                                                    <th style="width: 15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allTeams as $t)
                                                    <tr class="align-middle">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $t->name }}</td>
                                                        <td></td>
                                                        <td>
                                                            <a wire:click="modify({{ $t->id }})"
                                                                class="btn rounded btn-primary"><i
                                                                    class="nav-icon bi bi-building-gear"></i></a>
                                                            <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                wire:click="delete({{ $t->id }})""
                                                                class="btn rounded btn-danger"><i
                                                                    class="nav-icon bi bi-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <div class="mx-5 py-2">{{ $allTeams->links() }}</div>


                                    </div> <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="row">

                                            <!-- Kolumna 2: Checkbox "Niekatywni" -->

                                            <div class="col-2">
                                                <p>filters...</p>

                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.card-footer-->
                                </div> <!-- /.card -->


                            </div>
                        </div> <!--end::Row-->
                    </div>
                </div> <!--end::App Content-->




            </main> <!--end::App Main-->
