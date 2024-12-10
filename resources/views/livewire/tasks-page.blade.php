<div>
    <h1>The whole world belongs to you.</h1>
    <div class="row">
        @foreach ($allTasks as $t)
            <div class="card col-md-6 mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $t->image) }}" class="img-fluid rounded-start" alt="$t->title">
                    </div>
                    <div class="col-md-8 bg-rdm text-white">
                        <div class="card-header">{{ $t->contest->name }}</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $t->title }}</h5>
                            <p class="card-text">{{ $t->description }}</p>





                        </div>
                        <div class="card-footer">

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="progress mt-3 bg-light" style="height: 3px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-sm-4"><a class="btn btn-light border-dark btn-sm float-end "
                                        wire:click='scoreModal({{ $t->id }})'>
                                        <i class="text-rdm bi bi-bullseye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>


    @if ($isOpen)
        <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header bg-rdm">
                        <h5 class="modal-title text-white">
                            Lets try your shot!
                        </h5>
                        <button wire:click="closeModal" type="button" class="btn-close bg-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">

                        Modal body
                    </div>

                    <div class="modal-footer">

                        Modal footer
                    </div>


                </div>
            </div>
        </div>
</div>

<div class="modal-backdrop fade show">

</div>
@endif
{{-- End Modal --}}

</div>
