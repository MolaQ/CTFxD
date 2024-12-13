<div class="card">
    <div class="card-header bg-rdm text-white">
        <h2>{{ $contest_name }} - {{ __('Rank!') }} (ID: {{ $contest_id }})</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="table-resposive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Points</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($allResults as $r)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $r->user->name }}</td>
                                <td>Otto</td>
                                <td>{{ $r->total_points }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-start">
            <div class="mx-1">
                <input wire:model.live='search' type="text" class="form-control border-rdm mx-1" id="search"
                    placeholder="search...">
            </div>
            <div class="mx-1">
                <select class="form-select border-rdm mx-1" wire:change="loadResults" wire:model="contest_id">
                    @foreach ($allContests as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>
</div>
