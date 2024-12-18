<div>
    <h2>Szczegóły zespołu: {{ $team->name }}</h2>
    <ul>
        @foreach ($team->users as $user)
            <li>{{ $user->name }} ({{ $user->email }})</li>
        @endforeach
    </ul>
</div>
