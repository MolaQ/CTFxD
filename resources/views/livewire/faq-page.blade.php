<div class="card">
    <div class="card-header bg-rdm text-white">
        <div class="d-flex justify-content-between mb-1 pt-1">
            <!-- Lewa strona: Przycisk -->
            <h3>FAQ</h3>

            <!-- Prawa strona: Pole wyszukiwania -->
            <div class="col-3">
                <input wire:model.live="search" id="search" class="mt-1 form-control border-rdm shadow-none"
                    placeholder="Szukaj...">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="accordion" id="accordionPanelsStayOpenExample">

            @foreach ($allFaqs as $f)
                @if ($loop->first)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#{{ $f->id }}" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                {{ $f->name }}
                            </button>
                        </h2>
                        <div id="{{ $f->id }}" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                {{ $f->description }}
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$loop->first)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#{{ $f->id }}" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTwo">
                                {{ $f->name }}
                            </button>
                        </h2>
                        <div id="{{ $f->id }}" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                {{ $f->description }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
    <div class="card-footer">
        <div>Filters</div>
    </div>
</div>
