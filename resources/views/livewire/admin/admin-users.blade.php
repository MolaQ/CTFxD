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
                                {{-- end Flash messages --}}
                                <div class="card">
                                    <div class="card-header">

                                        <div class="d-flex justify-content-between mb-1 pt-1">
                                            <!-- Lewa strona: Przycisk -->
                                            <button class="btn btn-rdm text-white">
                                                <i class="bi bi-plus"></i> ADD USER
                                            </button>

                                            <!-- Prawa strona: Pole wyszukiwania -->
                                            <div class="col-3">
                                                <input wire:model.live="search" id="search"
                                                    class="form-control border-rdm shadow-none"
                                                    placeholder="Szukaj użytkownika">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%">#</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th style="width: 35%">School</th>
                                                    <th style="width: 15%">City</th>
                                                    <th style="width: 15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr class="align-middle">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->school->name ?? '-' }}</td>
                                                        <td>{{ $user->school->city ?? '-' }}</td>
                                                        <td>
                                                            <a wire:click="changeState({{ $user->id }})"
                                                                class="btn rounded btn-{{ $user->is_active ? 'success' : 'secondary' }}"><i
                                                                    class="nav-icon bi bi-toggle2-{{ $user->is_active ? 'on' : 'off' }}">

                                                                </i></a>
                                                            <a wire:click="modify({{ $user->id }})"
                                                                class="btn rounded btn-primary"><i
                                                                    class="nav-icon bi bi-building-gear"></i></a>
                                                            <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                wire:click="delete({{ $user->id }})""
                                                                class="btn rounded btn-danger"><i
                                                                    class="nav-icon bi bi-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <div class="mx-5 py-2">{{ $users->links() }}</div>
                                    </div> <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="row">

                                            <!-- Kolumna 2: Checkbox "Niekatywni" -->
                                            <div class="col-2">
                                                <div class="form-check form-switch">
                                                    <input wire:model.live="isActive" class="form-check-input"
                                                        type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Niekatywni</label>
                                                </div>

                                            </div>

                                            <div class="col-2">
                                                <div class="form-check form-switch">
                                                    <input wire:model.live="hasSchool" class="form-check-input"
                                                        type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Bez
                                                        Szkoły</label>
                                                </div>

                                            </div>

                                            <div class="col-2">
                                                <div class="form-check form-switch">
                                                    <input wire:model.live="hasSchool" class="form-check-input"
                                                        type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Bez
                                                        Zespołu</label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.card-footer-->
                                </div> <!-- /.card -->
                            </div>
                        </div> <!--end::Row-->
                    </div>
                </div> <!--end::App Content-->

                {{-- Modal begining --}}

                @if ($isOpen)
                    <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header bg-rdm">
                                    <h5 class="modal-title text-white">
                                        {{ $user_id ? 'Edit user' : 'Create user' }}
                                    </h5>
                                    <button wire:click="closeModal" type="button" class="btn-close bg-white"
                                        data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form wire:submit.prevent="store">
                                        <div class="form-group ml-1 py-1">
                                            <label for="name">User</label>
                                            <input wire:model="form.name" type="text" class="form-control"
                                                id="name" placeholder="Enter user name">
                                        </div>
                                        <div class="form-group ml-1 py-1">
                                            <label for="email">Email</label>
                                            <input wire:model="form.email" type="email" class="form-control"
                                                id="email" placeholder="Enter email">
                                        </div>
                                        <div class="form-group ml-1 py-1">
                                            <label for="city">School</label>
                                            <select wire:model='form.school_id' class="form-select" id="school_id">
                                                @foreach ($allSchools as $s)
                                                    <option value="{{ $s->id }}" @selected($selectedSchool == $s->id)>
                                                        {{ $s->name }}
                                                @endforeach

                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-4">
                                            {{ $user_id ? 'Update user' : 'Create user' }}
                                        </button>
                                        <button type="button" wire:click="closeModal"
                                            class="btn btn-secondary mt-4">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-backdrop fade show">

                    </div>
                @endif
                {{-- End Modal --}}


            </main> <!--end::App Main--> <!--begin::Footer-->
