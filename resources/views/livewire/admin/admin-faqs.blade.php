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
                                    <i class="bi bi-plus"></i> ADD FAQ
                                </button>

                                <!-- Prawa strona: Pole wyszukiwania -->
                                <div class="col-3">
                                    <input wire:model.live="search" id="search"
                                        class="form-control border-rdm shadow-none"
                                        placeholder="Szukaj pytania">
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">#</th>
                                        <th>Faq</th>
                                        <th>Description</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allFaqs as $faq)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $faq->name }}</td>
                                            <td>{{ $faq->description }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a wire:click="modify({{ $faq->id }})"
                                                        class="btn rounded btn-primary"><i
                                                            class="nav-icon bi bi-building-gear"></i></a>
                                                    <a onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                        wire:click="delete({{ $faq->id }})""
                                                        class="btn rounded btn-danger"><i
                                                            class="nav-icon bi bi-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="mx-5 py-2">links may be here</div>
                        </div>
                        <div class="card-footer">
                            <p>filters...</p>
                        </div>
                    </div>
                </div>
            </div> <!--end::Row-->
        </div>
    </div> <!--end::App Content-->

</main> <!--end::App Main--> <!--begin::Footer-->

