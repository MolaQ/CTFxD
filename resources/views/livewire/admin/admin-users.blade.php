            <main class="app-main"> <!--begin::App Content Header-->
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
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 2%">#</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th style="width: 20%">School</th>
                                                        <th style="width: 20%">Team</th>
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
                                                            <td>{{ $user->team->name ?? '-' }}</td>
                                                            <td>
                                                                <div class="d-flex gap-1">
                                                                    <a wire:click="verify({{ $user->id }})"
                                                                        class="btn rounded btn-{{ $user->verified ? 'purple' : 'secondary' }}"><i
                                                                            class="nav-icon bi bi-bell{{ $user->verified ? '-fill' : '' }}">

                                                                        </i></a>
                                                                    <a wire:click="changeState({{ $user->id }})"
                                                                        class="btn rounded btn-{{ $user->is_active ? 'success' : 'secondary' }}"><i
                                                                            class="nav-icon bi bi-toggle2-{{ $user->is_active ? 'on' : 'off' }}">

                                                                        </i></a>
                                                                    <a wire:click="modify({{ $user->id }})"
                                                                        class="btn rounded btn-primary"><i
                                                                            class="nav-icon bi bi-person-fill-gear"></i></a>
                                                                    <a wire:click="setPass({{ $user->id }})"
                                                                        class="btn rounded btn-pink"><i
                                                                            class="nav-icon bi bi-key-fill"></i></a>
                                                                    <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                        wire:click="delete({{ $user->id }})""
                                                                        class="btn rounded btn-danger"><i
                                                                            class="nav-icon bi bi-trash"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mx-5 py-2">{{ $users->links() }}</div>
                                    </div> <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="row">

                                            <div>Filtrowanie użytkowników:</div>
                                            <div class="ms-1">
                                                <div class="form-check form-switch">
                                                    <input wire:model.live="unVerified" class="form-check-input"
                                                        type="checkbox" role="switch" id="verified">
                                                    <label class="form-check-label"
                                                        for="verified">Niezweryfikowani</label>
                                                </div>


                                                <div class="form-check form-switch">
                                                    <input wire:model.live="inactive" class="form-check-input"
                                                        type="checkbox" role="switch" id="inactive">
                                                    <label class="form-check-label" for="inactive">Niekatywni</label>
                                                </div>




                                                <div class="form-check form-switch">
                                                    <input wire:model.live="noSchool" class="form-check-input"
                                                        type="checkbox" role="switch" id="noSchool">
                                                    <label class="form-check-label" for="noSchool">Bez
                                                        Szkoły</label>
                                                </div>




                                                <div class="form-check form-switch">
                                                    <input wire:model.live="noTeam" class="form-check-input"
                                                        type="checkbox" role="switch" id="noTeam">
                                                    <label class="form-check-label" for="noTeam">Bez
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
                                            <input wire:model="form.name" type="text"
                                                class="form-control  @error('form.name') is-invalid @enderror"
                                                id="name" placeholder="Enter user name">
                                            @error('form.name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group ml-1 py-1">
                                            <label for="email">Email</label>
                                            <input wire:model="form.email" type="email"
                                                class="form-control @error('form.email') is-invalid @enderror"
                                                id="email" placeholder="Enter email">
                                            @error('form.email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @if (!$user_id)
                                            <div class="form-group">
                                                <label for="password">{{ __('password') }}</label>
                                                <input type="password"
                                                    class="form-control @error('form.password') is-invalid @enderror"
                                                    id="email" wire:model="form.password" name="password">
                                                @error('form.password')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    for="password_confirmation">{{ __('password confirmation') }}</label>
                                                <input type="password"
                                                    class="form-control @error('form.password_confirmation') is-invalid @enderror"
                                                    id="email" wire:model="form.password_confirmation"
                                                    name="password_confirmation">
                                                @error('form.password_confirmation')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                        <div class="form-group ml-1 py-1">
                                            <label for="school_id">School</label>
                                            <select wire:model='form.school_id' class="form-select" id="school_id">
                                                <option value="">None</option>
                                                <!-- Opcja wyboru pustej wartości -->
                                                @foreach ($allSchools as $s)
                                                    <option value="{{ $s->id }}">
                                                        {{ $s->name }}
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group ml-1 py-1">
                                            <label for="team_id">Team</label>
                                            <select wire:model='form.team_id' class="form-select" id="team_id">
                                                <option value="">None</option>
                                                <!-- Opcja wyboru pustej wartości -->
                                                @foreach ($allTeams as $team)
                                                    <option value="{{ $team->id }}">
                                                        {{ $team->name }}
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

                @if ($isSetPass)
                    <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header bg-rdm">
                                    <h5 class="modal-title text-white"> Set new password
                                    </h5>
                                    <button wire:click="closePassModal" type="button" class="btn-close bg-white"
                                        data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form wire:submit.prevent="setNewPass">
                                        <div class="form-group">
                                            <label for="password">{{ __('password') }}</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" wire:model="password" name="password">
                                            @error('password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="password_confirmation">{{ __('password confirmation') }}</label>
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="email" wire:model="password_confirmation"
                                                name="password_confirmation">
                                            @error('password_confirmation')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-4">
                                            Save
                                        </button>
                                        <button type="button" wire:click="closePassModal"
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
