        <div>
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
                                        <h3 class="card-title pt-2"><button wire:click="create"
                                                class="btn bg-rdm text-white">Create new user</button></h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h3 class="card-title pt-2">Users list</h3>
                                            </div> <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 2%">#</th>
                                                            <th>Username</th>
                                                            <th>Email</th>
                                                            <th style="width: 10%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($users as $user)
                                                            <tr class="align-middle">
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>

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
                                        </div>
                                    </div> <!-- /.card-body -->
                                    <div class="card-footer">Footer</div>
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
                                            <label for="city">Email</label>
                                            <input wire:model="form.email" type="email" class="form-control"
                                                id="email" placeholder="Enter email">
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
        </div>
