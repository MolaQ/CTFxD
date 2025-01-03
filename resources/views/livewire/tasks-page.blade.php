<div class="row">
    @foreach ($allTasks as $t)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card text-center border-0 shadow rounded-5 p-3 my-1" style="max-width: 50rem;">
                <div class="card-header">
                    <img src="{{ asset('storage/' . $t->image) }}" class="card-img-top img-fluid rounded-start"
                        alt="$t->title">
                </div>
                <div class="icon text-rdm" style="font-size: 3rem;">
                    <i class="bi bi-bullseye"></i>
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $t->title }}</h4>
                    <p class="card-text">{{ $t->description }}</p>
                    <a wire:click='scoreModal({{ $t->id }})' href="#" class="btn btn-rdm text-white"><i
                            class="text-white bi bi-bullseye me-1"></i>Send your answer</a>
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
                    <form wire:submit.prevent="scoreAttempt({{ $task_id }})">
                        <div class="modal-body">
                            <div class="mb-3">
                                {{ $attempts }}attempts left
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-rdm text-white"><i class="bi bi-pencil"></i></span>
                                <input wire:model='answer' type="text" id="shot" class="border-rdm form-control"
                                    placeholder="Wprowadź odpowiedź">
                            </div>
                        </div>

                        <div class="modal-footer">

                            <button type="submit" class="btn btn-rdm mt-1">
                                Shot to earn ~{{ round($points, 1) }} pts.
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
</div>

<div class="modal-backdrop fade show">

</div>
@endif



</div>
