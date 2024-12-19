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
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 2%">#</th>
                                                        <th>Contest</th>
                                                        <th>Logo</th>
                                                        <th>Time</th>
                                                        <th style="width: 15%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($allContests as $t)
                                                        <tr class="align-middle">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td><strong>{{ $t->name }}</strong><br><i
                                                                    class="mx-1">{{ $t->description }}</i></td>
                                                            <td></td>
                                                            <td>
                                                                <button
                                                                    class="btn btn-sm btn-{{ $t->status($t->start_time, $t->end_time)['color'] }}"
                                                                    style="width: 120px;">{{ $t->status($t->start_time, $t->end_time)['status'] }}
                                                                </button>

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
                                            <div class="mx-5 py-2">{{ $allContests->links() }}</div>

                                        </div>
                                    </div> <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="row">

                                            <div class="row">
                                                <div>Wybierz zadania:</div>
                                                <div class="gap-2">
                                                    <div class="form-check">
                                                        <input wire:model.live='selectContest'
                                                            class="form-check-input border-primary" name="selectContest"
                                                            type="radio" value="all" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Wszystkie zadania
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input wire:model.live='selectContest'
                                                            class="form-check-input border-primary" name="selectContest"
                                                            type="radio" value="active" id="defaultCheck2">
                                                        <label class="form-check-label" for="defaultCheck2">
                                                            Aktywne
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input wire:model.live='selectContest'
                                                            class="form-check-input border-primary" name="selectContest"
                                                            type="radio" value="upcoming" id="defaultCheck2">
                                                        <label class="form-check-label" for="defaultCheck2">
                                                            Nadchodzące
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input wire:model.live='selectContest'
                                                            class="form-check-input border-primary" name="selectContest"
                                                            type="radio" value="expired" id="defaultCheck2">
                                                        <label class="form-check-label" for="defaultCheck2">
                                                            Zakończone
                                                        </label>
                                                    </div>
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
                                        <div class="form-group ml-1 py-1">
                                            <label for="start_time">Start time</label>
                                            <input wire:model="form.start_time" type="datetime-local"
                                                class="form-control" id="start_time" placeholder="Enter start time">
                                        </div>
                                        <div class="form-group ml-1 py-1">
                                            <label for="end_time">End time</label>
                                            <input wire:model="form.end_time" type="datetime-local"
                                                class="form-control" id="end_time" placeholder="Enter end time">
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
