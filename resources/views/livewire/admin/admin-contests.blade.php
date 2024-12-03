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
                                {{-- Flash messages --}}
                                @include('livewire.admin.layouts.components.flash')

                                <div class="card">
                                    <div class="card-header">


                                        <div class="d-flex justify-content-between mb-1 pt-1">
                                            <!-- Lewa strona: Przycisk -->
                                            <button wire:click="create" class="btn btn-rdm text-white">
                                                <i class="bi bi-plus"></i> ADD CONTEST
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
                                                    <th>Contest</th>
                                                    <th>Start time</th>
                                                    <th>End time</th>
                                                    <th style="width: 15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allContests as $t)
                                                    <tr class="align-middle">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><strong>{{ $t->name }}</strong><br><i
                                                                class="mx-1">{{ $t->description }}</i></td>
                                                        <td>{{ $t->start_time }}</td>
                                                        <td>{{ $t->end_time }}</td>
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
                                        <div class="mx-5 py-2">{{ $allContests->links() }}</div>


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


                {{-- Modal begining --}}

                @if ($isOpen)
                    <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header bg-rdm">
                                    <h5 class="modal-title text-white">
                                        {{ $contest_id ? 'Edit contest' : 'Create contest' }}
                                    </h5>
                                    <button wire:click="closeModal" type="button" class="btn-close bg-white"
                                        data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form wire:submit.prevent="store">
                                        <div class="form-group ml-1 py-1">
                                            <label for="name">Contest</label>
                                            <input wire:model="form.name" type="text" class="form-control"
                                                id="name" placeholder="Enter contest name">
                                        </div>
                                        <div class="form-group ml-1 py-1">
                                            <label for="description">Description</label>
                                            <input wire:model="form.description" type="text" class="form-control"
                                                id="description" placeholder="Contest description">
                                        </div>


                                        <button type="submit" class="btn btn-primary mt-4">
                                            {{ $contest_id ? 'Update contest' : 'Create contest' }}
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




            </main> <!--end::App Main-->
