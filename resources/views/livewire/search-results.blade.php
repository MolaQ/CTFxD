<div class="dropdown w-100 position-relative">
    <input type="text" wire:model.live="query" placeholder="Szukaj..." class="form-control border rounded" />

    @if ($query)
        <div class="search-results position-absolute">
            {{-- Użytkownicy --}}
            @if ($users->isNotEmpty())
                <h5>Użytkownicy</h5>
                @foreach ($users as $user)
                    <a href="{{ route('user.details', $user->id) }}">
                        {{ $user->name }} ({{ $user->email }})
                    </a>
                @endforeach
            @endif

            {{-- Zespoły --}}
            @if ($teams->isNotEmpty())
                <h5>Zespoły</h5>
                @foreach ($teams as $team)
                    <a href="{{ route('team.details', $team->id) }}">
                        {{ $team->name }}
                    </a>
                @endforeach
            @endif

            {{-- Szkoły --}}
            @if ($schools->isNotEmpty())
                <h5>Szkoły</h5>
                @foreach ($schools as $school)
                    <a href="{{ route('school.details', $school->id) }}">
                        {{ $school->name }}
                    </a>
                @endforeach
            @endif

            {{-- Brak wyników --}}
            @if ($users->isEmpty() && $teams->isEmpty() && $schools->isEmpty())
                <div class="no-results">Brak wyników...</div>
            @endif
        </div>
    @endif
</div>
