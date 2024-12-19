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
                                    <i class="bi bi-plus"></i> ADD FAQ
                                </button>

                                <!-- Prawa strona: Pole wyszukiwania -->
                                <div class="col-3">
                                    <input wire:model.live="search" id="search"
                                        class="form-control border-rdm shadow-none" placeholder="Szukaj pytania">
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-reponsive">
                                <table class="table">
                                    <thead>
                                        <tr class="align-middle align-items-center">
                                            <th>#</th>
                                            <th>Faq</th>
                                            <th style="width: 50%;">Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($allFaqs as $faq)
                                            <tr class="align-middle align-items-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $faq->name }}</td>
                                                <td>{{ $faq->description }}</td>
                                                <td>

                                                    <div class="d-flex gap-1">
                                                        @if (!empty($search))
                                                            @if ($loop->first)
                                                                <a wire:click="modify({{ $faq->id }})"
                                                                    class="btn rounded btn-primary">
                                                                    <i class="nav-icon bi bi-building-gear"></i>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                    wire:click="delete({{ $faq->id }})""
                                                                    class=" btn rounded btn-danger">
                                                                    <i class="nav-icon bi bi-trash"></i>
                                                                </a>
                                                            @elseif (!$loop->first && !$loop->last)
                                                                <a wire:click="modify({{ $faq->id }})"
                                                                    class="btn rounded btn-primary"><i
                                                                        class="nav-icon bi bi-building-gear"></i></a>
                                                                <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                    wire:click="delete({{ $faq->id }})""
                                                                    class=" btn rounded btn-danger"><i
                                                                        class="nav-icon bi bi-trash"></i></a>
                                                            @elseif ($loop->last)
                                                                <a wire:click="modify({{ $faq->id }})"
                                                                    class="btn rounded btn-primary"><i
                                                                        class="nav-icon bi bi-building-gear"></i></a>
                                                                <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                    wire:click="delete({{ $faq->id }})""
                                                                    class=" btn rounded btn-danger"><i
                                                                        class="nav-icon bi bi-trash"></i></a>
                                                            @endif
                                                        @else
                                                            @if ($loop->first)
                                                                <a wire:click="modify({{ $faq->id }})"
                                                                    class="btn rounded btn-primary">
                                                                    <i class="nav-icon bi bi-building-gear"></i>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                    wire:click="delete({{ $faq->id }})""
                                                                    class=" btn rounded btn-danger">
                                                                    <i class="nav-icon bi bi-trash"></i>
                                                                </a>
                                                                <a wire:click="orderUp({{ $faq->order }})"
                                                                    class="btn rounded btn-dark disabled"><i
                                                                        class="nav-icon bi-caret-up-fill"></i></a>
                                                                <a wire:click="orderDown({{ $faq->order }})"
                                                                    class="btn rounded btn-dark"><i
                                                                        class="nav-icon bi-caret-down-fill"></i></a>
                                                            @endif

                                                            @if (!$loop->first && !$loop->last)
                                                                <a wire:click="modify({{ $faq->id }})"
                                                                    class="btn rounded btn-primary"><i
                                                                        class="nav-icon bi bi-building-gear"></i></a>
                                                                <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                    wire:click="delete({{ $faq->id }})""
                                                                    class=" btn rounded btn-danger"><i
                                                                        class="nav-icon bi bi-trash"></i></a>
                                                                <a wire:click="orderUp({{ $faq->order }})"
                                                                    class="btn rounded btn-dark"><i
                                                                        class="nav-icon bi-caret-up-fill"></i></a>

                                                                <a wire:click="orderDown({{ $faq->order }})"
                                                                    class="btn rounded btn-dark"><i
                                                                        class="nav-icon bi-caret-down-fill"></i></a>
                                                            @endif


                                                            @if ($loop->last)
                                                                <a wire:click="modify({{ $faq->id }})"
                                                                    class="btn rounded btn-primary"><i
                                                                        class="nav-icon bi bi-building-gear"></i></a>
                                                                <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                                    wire:click="delete({{ $faq->id }})""
                                                                    class=" btn rounded btn-danger"><i
                                                                        class="nav-icon bi bi-trash"></i></a>
                                                                <a wire:click="orderUp({{ $faq->order }})"
                                                                    class="btn rounded btn-dark"><i
                                                                        class="nav-icon bi-caret-up-fill"></i></a>
                                                                <a wire:click="orderDown({{ $faq->order }})"
                                                                    class="btn rounded btn-dark disabled"><i
                                                                        class="nav-icon bi-caret-down-fill"></i></a>
                                                            @endif
                                                        @endif


                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>


                                </table>
                            </div>

                            <div class="mx-5 py-2">{{ $allFaqs->links() }}</div>
                        </div>
                        <div class="card-footer">
                            <p>filters...</p>
                        </div>
                    </div>
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
                            {{ $faq_id ? 'Edit FAQ' : 'Create FAQ' }}
                        </h5>
                        <button wire:click="closeModal" type="button" class="btn-close bg-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="store">
                            <div class="form-group ml-1 py-1">
                                <label for="name">FAQ</label>
                                <input wire:model="form.name" type="text"
                                    class="form-control @error('form.name') is-invalid @enderror" id="name"
                                    placeholder="Enter faq title">
                                @error('form.name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group ml-1 py-1">
                                <label for="description">Description</label>
                                <textarea wire:model="form.description" class="form-control @error('form.description') is-invalid @enderror"
                                    placeholder="Eneter the FAQ description here" id="description" style="height: 200px"></textarea>
                                @error('form.description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <input wire:model="form.order" type="hidden">
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">
                                {{ $faq_id ? 'Update FAQ' : 'Create FAQ' }}
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

</main>
<!--end::App Main-->
<!--begin::Footer-->
