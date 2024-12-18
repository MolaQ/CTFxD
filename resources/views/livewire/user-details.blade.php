<div>
    <h2>Szczegóły użytkownika: {{ $user->name }}</h2>
    <p>Email: {{ $user->email }}</p>
    <p>Zespół: {{ $user->team->name ?? 'Brak' }}</p>
    <p>Szkoła: {{ $user->school->name ?? 'Brak' }}</p>
</div>
