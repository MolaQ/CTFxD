<div>
    <h1>The whole world belongs to you.</h1>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($allTasks as $t)
            <div class="col">
                <div class="card">
                    <div class="card-header bg-rdm text-white">
                        <div class="d-flex justify-content-between">
                            <h3 class="my-2">{{ $t->contest->name }}</h3>
                            <a class="py-2 btn btn-light btn-lg" wire:click='scoreModal({{ $t->id }})'>
                                <i class="text-rdm bi bi-bullseye"></i>
                            </a>
                        </div>

                    </div>
                    <img src="{{ asset('storage/' . $t->image) }}" class="card-img-top img-fluid rounded-start"
                        alt="$t->title">
                    <div class="card-body bg-rdm text-white">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">{{ $t->title }}</h5>
                                <p class="card-text">{{ $t->description }}</p>
                            </div>
                            <div>
                                <a class="py-2 btn btn-light btn-lg" wire:click='openInfoModal({{ $t->id }})'>
                                    <i class="text-rdm bi bi-info-circle-fill"></i>
                                </a>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer bg-rdm">
                        <div class="progress progress-bar-striped progress-bar-animated w-100 bg-success"
                            role="progressbar" aria-label="Success example"
                            aria-valuenow="{{ $t->elapsedTime($t->start_time) }}" aria-valuemin="0"
                            aria-valuemax="{{ $t->durationTime($t->start_time, $t->end_time) }}" style="height: 2px;">
                            <div class="progress-bar bg-dark"
                                style="width: {{ ($t->elapsedTime($t->start_time) / $t->durationTime($t->start_time, $t->end_time)) * 100 }}%; height: 2px;">
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        @endforeach



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

    @if ($isInfo)
        <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header bg-rdm">
                        <h5 class="modal-title text-white">
                            {{ $contestName }} | {{ $title }}
                        </h5>
                        <button wire:click="closeModal" type="button" class="btn-close bg-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">

                        {{ $description }}
                    </div>

                    <div class="modal-footer">
                        <div class="progress progress-bar-striped progress-bar-animated w-100 bg-success"
                            role="progressbar" aria-label="Success example" aria-valuenow="{{ $elapsedTime }}"
                            aria-valuemin="0" aria-valuemax="{{ $durationTime }}">
                            <div class="progress-bar bg-dark"
                                style="width: {{ ($elapsedTime / $durationTime) * 100 }}%">
                            </div>
                        </div>





                        {{-- <div class="progress w-100" style="height: 5px;">
                            <div class="progress-bar bg-dark" role="progressbar"
                                style="width: {{ $elapsedTime / $durationTime }}%;"
                                aria-valuenow="{{ $durationTime - $elapsedTime }}" aria-valuemin="0"
                                aria-valuemax="{{ $durationTime }}"></div>
                        </div>
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{ 100 - $elapsedTime / $durationTime }}%;"
                            aria-valuenow="{{ $elapsedTime }}" aria-valuemin="0" aria-valuemax="{{ $durationTime }}">
                        </div> --}}
                    </div>
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
