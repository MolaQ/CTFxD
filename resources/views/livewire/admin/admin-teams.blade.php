            <main class="app-main">
                <!--begin::App Content Header-->
                <div class="app-content-header"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">{{ $title ?? 'Page Title' }}</h3>
                            </div>
                        </div> <!--end::Row-->
                    </div> <!--end::Container-->
                </div> <!--end::App Content Header--> <!--begin::App Content-->
                <div class="app-content"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-12"> <!-- Default box -->
                                <div class="card">
                                    <div class="card-header">


                                        <div class="d-flex justify-content-between mb-1 pt-1">
                                            <!-- Lewa strona: Przycisk -->
                                            <button wire:click="create" class="btn btn-rdm text-white">
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
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Team name</th>
                                                        <th>Manager</th>
                                                        <th>Members</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($allTeams as $t)
                                                        <tr class="align-middle">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $t->name }}
                                                            </td>
                                                            <td>
                                                                {{ $t->manager->name ?? 'brak managera' }} @if (isset($t->manager->name))
                                                                    <i onclick="return confirm('Are you sure you want to delete this manager?') || event.stopImmediatePropagation()"
                                                                        wire:click="removeTeamManager({{ $t->id }}, {{ $t->manager->id }})"
                                                                        class="text-rdm bi bi-file-minus-fill"></i>
                                                                @else
                                                                    <i wire:click="openAddManager({{ $t->id }})"
                                                                        class="text-success bi bi-file-plus-fill"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <ul>
                                                                    @foreach ($t->users as $user)
                                                                        <li>{{ $user->name }}@if ($user->verified)
                                                                                <i
                                                                                    class="text-purple bi bi-hand-thumbs-up-fill"></i>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>

                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-1">
                                                                    <a wire:click="modify({{ $t->id }})"
                                                                        class="btn rounded btn-primary"><i
                                                                            class="nav-icon bi bi-building-gear"></i></a>
                                                                    <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                        wire:click="delete({{ $t->id }})""
                                                                        class="btn rounded btn-danger"><i
                                                                            class="nav-icon bi bi-trash"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            <div class="mx-5 py-2">{{ $allTeams->links() }}</div>

                                        </div>
                                    </div> <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="row">

                                            <p>filters...</p>

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
                                        {{ $team_id ? 'Edit team' : 'Create team' }}
                                    </h5>
                                    <button wire:click="closeModal" type="button" class="btn-close bg-white"
                                        data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form wire:submit.prevent="store">
                                        <div class="form-group ml-1 py-1">
                                            <label for="name">Team</label>
                                            <input wire:model="form.name" type="text"
                                                class="form-control @error('form.name') is-invalid @enderror"
                                                id="name" placeholder="Enter team name">
                                            @error('form.name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <button type="submit" class="btn btn-primary mt-4">
                                            {{ $team_id ? 'Update team' : 'Create team' }}
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


                @if ($addManager)
                    <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header bg-rdm">
                                    <h5 class="modal-title text-white">
                                        Appoint a new manager
                                    </h5>
                                    <button wire:click="closeModal" type="button" class="btn-close bg-white"
                                        data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <div class="form-group ml-1 py-1">
                                        <label for="name">Select manager</label>
                                        <input wire:model.live="searchManagers" type="text" class="form-control"
                                            id="name" placeholder="Search manager">

                                    </div>

                                    <div class="list-group mt-3">
                                        @foreach ($allManagers as $a)
                                            <a wire:click='addTeamManager({{ $a->id }})' href="#"
                                                class="px-2 mx-1 mb-1 list-group-item list-group-item-action">
                                                <i class="text-success bi bi-file-plus-fill">
                                                </i>
                                                {{ $a->name }}
                                            </a>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-backdrop fade show">

                    </div>
                @endif




            </main> <!--end::App Main-->
