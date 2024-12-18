<div>
    <h2>Szczegóły szkoły: {{ $school->name }}</h2>
    <ul>
        @foreach ($school->users as $user)
            <li>{{ $user->name }} ({{ $user->email }})</li>
        @endforeach
    </ul>
</div>
