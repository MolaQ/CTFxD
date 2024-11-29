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
                                            <button wire:click="create" class="btn btn-rdm text-white">
                                                <i class="bi bi-plus"></i> ADD SCHOOL
                                            </button>

                                            <!-- Prawa strona: Pole wyszukiwania -->
                                            <div class="col-3">
                                                <input wire:model.live="search" id="search"
                                                    class="form-control border-rdm shadow-none"
                                                    placeholder="Szukaj szkoły">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%">#</th>
                                                    <th>School</th>
                                                    <th>City</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allschools as $school)
                                                    <tr class="align-middle">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $school->name }}</td>
                                                        <td>{{ $school->city }}</td>
                                                        <td>

                                                            <a wire:click="modify({{ $school->id }})"
                                                                class="btn rounded btn-primary"><i
                                                                    class="nav-icon bi bi-building-gear"></i></a>
                                                            <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                wire:click="delete({{ $school->id }})""
                                                                class="btn rounded btn-danger"><i
                                                                    class="nav-icon bi bi-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <div class="mx-5 py-2">{{ $allschools->links() }}</div>
                                    </div>
                                    <div class="card-header">
                                        <p>filters...</p>
                                    </div>
                                </div>
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
                                        {{ $school_id ? 'Edit School' : 'Create School' }}
                                    </h5>
                                    <button wire:click="closeModal" type="button" class="btn-close bg-white"
                                        data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form wire:submit.prevent="store">
                                        <div class="form-group ml-1 py-1">
                                            <label for="name">School</label>
                                            <input wire:model="name" type="text" class="form-control" id="name"
                                                placeholder="Enter school name">
                                        </div>
                                        <div class="form-group ml-1 py-1">
                                            <label for="city">City</label>
                                            <input wire:model="city" type="text" class="form-control" id="city"
                                                placeholder="Enter city">
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-4">
                                            {{ $school_id ? 'Update School' : 'Create School' }}
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
