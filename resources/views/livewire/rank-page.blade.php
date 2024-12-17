<div class="card">
    <div class="card-header bg-rdm text-white">
        <h2>{{ $contest_name }} - {{ __('Rank!') }} (ID: {{ $contest_id }})</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="table-resposive">
                <table class="table">
                    @if ($selectRank === 'individual')
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">School</th>
                                <th scope="col">Team</th>
                                <th scope="col">Points</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($allResults as $r)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $r->user->name }}</td>
                                    <td>{{ $r->user->school->name ?? '' }}</td>
                                    <td>{{ $r->user->team->name ?? '' }}</td>
                                    <td>{{ round($r->total_points, 3) }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    @endif

                    @if ($selectRank === 'team')
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Team</th>
                                <th scope="col">Points</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($allResults as $r)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $r->team_name }}</td>
                                    <td>{{ round($r->total_points, 3) }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    @endif
                    @if ($selectRank === 'school')
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">School</th>
                                <th scope="col">Points</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($allResults as $r)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $r->school_name }}</td>
                                    <td>{{ round($r->total_points, 3) }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    @endif


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
        <div class="d-flex mt-3 justify-content-start">
            <div class="form-check form-check-inline">
                <input wire:model='selectRank' wire:click="changeRank('individual')" class="form-check-input bg-rdm"
                    type="radio" id="individual" value="individual">
                <label class="form-check-label" for="individual">Individual rank</label>
            </div>
            <div class="form-check form-check-inline">
                <input wire:model='selectRank' wire:click="changeRank('team')" class="form-check-input bg-rdm"
                    type="radio" id="team" value="team">
                <label class="form-check-label" for="team">Team rank</label>
            </div>
            <div class="form-check form-check-inline">
                <input wire:model='selectRank' wire:click="changeRank('school')" class="form-check-input bg-rdm"
                    type="radio" id="school" value="school">
                <label class="form-check-label" for="school">School rank</label>
            </div>

        </div>
    </div>
</div>
