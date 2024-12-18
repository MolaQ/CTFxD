<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ $title ?? 'Page Title' }}</h3>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">


                            <div class="d-flex justify-content-between mb-1 pt-1">
                                <!-- Lewa strona: Przycisk -->
                                <button wire:click="create" class="btn btn-rdm text-white">
                                    <i class="bi bi-plus"></i> ADD TASK
                                </button>

                                <!-- Prawa strona: Pole wyszukiwania -->
                                <div class="col-3">
                                    <input wire:model.live="search" id="search"
                                        class="form-control border-rdm shadow-none" placeholder="Szukaj Zadania">
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="align-middle align-items-center">
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Image</th>
                                            <th>Contest</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allTasks as $t)
                                            <tr class="align-middle align-items-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td><strong>{{ $t->title }}
                                                    </strong><br><i class="mx-1">{{ $t->description }}</i>
                                                </td>
                                                <td>

                                                    <img src="/storage/{{ $t->image }}" width="60"
                                                        height="40" class="img-fluid" alt="{{ $t->title }}">


                                                </td>
                                                <td>
                                                    {{ $t->contest->name }}
                                                </td>
                                                <td>
                                                    <button
                                                        class="btn btn-sm btn-{{ $t->status($t->start_time, $t->end_time)['color'] }}"
                                                        style="width: 120px;">{{ $t->status($t->start_time, $t->end_time)['status'] }}
                                                    </button>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a wire:click="modify({{ $t->id }})"
                                                            class="btn rounded btn-primary"><i
                                                                class="nav-icon bi bi-building-gear"></i></a>
                                                        <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                            wire:click="delete({{ $t->id }})""
                                                            class=" btn rounded btn-danger"><i
                                                                class="nav-icon bi bi-trash"></i></a>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mx-5 py-2">{{ $allTasks->links() }}</div>


                        </div> <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div>Wybierz zadania:</div>
                                <div class="gap-2">
                                    <div class="form-check">
                                        <input wire:model.live='selectTasks' class="form-check-input border-primary"
                                            name="selectContest" type="radio" value="all" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Wszystkie zadania
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input wire:model.live='selectTasks' class="form-check-input border-primary"
                                            name="selectContest" type="radio" value="active" id="defaultCheck2">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Aktywne
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input wire:model.live='selectTasks' class="form-check-input border-primary"
                                            name="selectContest" type="radio" value="upcoming" id="defaultCheck2">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Nadchodzące
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input wire:model.live='selectTasks' class="form-check-input border-primary"
                                            name="selectContest" type="radio" value="expired" id="defaultCheck2">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Zakończone
                                        </label>
                                    </div>
                                </div>




                            </div>

                        </div>
                        <!-- /.card-footer-->
                    </div> <!-- /.card -->


                </div>
            </div>
            <!--end::Row-->
        </div>
    </div>
    <!--end::App Content-->


    {{-- Modal begining --}}

    @if ($isOpen)
        <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header bg-rdm">
                        <h5 class="modal-title text-white">
                            {{ $task_id ? 'Edit task' : 'Create task' }}
                        </h5>
                        <button wire:click="closeModal" type="button" class="btn-close bg-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="store">

                            <div class="form-group ml-1 py-1">
                                <label for="contest_id">Category</label>
                                <select wire:model='form.contest_id'
                                    class="form-select @error('form.contest_id') is-invalid @enderror"
                                    id="contest_id">
                                    <!-- Opcja wyboru pustej wartości -->
                                    <option value="">Choose contest
                                        @foreach ($allContests as $c)
                                    <option value="{{ $c->id }}">
                                        {{ $c->name }}
    @endforeach

    </select>
    @error('form.contest_id')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    </div>
    <div class="form-group ml-1 py-1">
        <label for="title">Task</label>
        <input wire:model="form.title" type="text" class="form-control @error('form.title') is-invalid @enderror"
            id="title" placeholder="Enter task title">
        @error('form.title')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group ml-1 py-1">
        <label for="description">Description</label>
        <input wire:model="form.description" type="text"
            class="form-control @error('form.description') is-invalid @enderror" id="description"
            placeholder="Enter task description">
        @error('form.description')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group ml-1 py-1">
        <label for="solution">Solution</label>
        <input wire:model="form.solution" type="text"
            class="form-control @error('form.solution') is-invalid @enderror" id="solution"
            placeholder="Enter task solution">
        @error('form.solution')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group ml-1 py-1">
        <label for="start_time">Start time</label>
        <input wire:model="form.start_time" type="datetime-local"
            class="form-control @error('form.start_time') is-ivalid @enderror" id="start_time"
            placeholder="Enter start time">
        @error('form.start_time')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group ml-1 py-1">
        <label for="end_time">End time</label>
        <input wire:model="form.end_time" type="datetime-local"
            class="form-control @error('form.end_time') is-ivalid @enderror" id="end_time"
            placeholder="Enter end time">
        @error('form.end_time')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group ml-1 py-1">

        <!-- Podgląd obrazu -->
        @if ($tempPath)
            <div class="mt-3">
                <img src="{{ $tempPath }}" alt="Image Preview" class="img-fluid">
            </div>
        @endif

        <label for="task_image">Upload Task Image</label>
        <input wire:model="form.image" type="file" class="form-control @error('form.image') is-invalid @enderror"
            id="task_image">
        @error('form.image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>


    <button type="submit" class="btn btn-primary mt-4">
        {{ $task_id ? 'Update task' : 'Create task' }}
    </button>
    <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Close</button>
    </form>
    </div>
    </div>
    </div>
    </div>

    <div class="modal-backdrop fade show">

    </div>
    @endif
    {{-- End Modal --}}




</main>
<!--end::App Main-->
