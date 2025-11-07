<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <!-- NAGŁÓWEK STRONY -->
    <header class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Ranking</h1>
        <p class="mt-1 text-lg text-gray-600">Sprawdź wyniki rywalizacji indywidualnej, drużynowej
            oraz szkolnej.</p>
    </header>

    <!-- PANEL STEROWANIA -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 p-4 bg-gray-50 rounded-lg shadow">
        <!-- Wyszukiwarka -->
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700">Wyszukaj</label>
            <input wire:model.live.debounce.300ms="search" id="search" type="text"
                placeholder="Nazwa, email, drużyna..."
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Wybór Konkursu -->
        <div>
            <label for="contest" class="block text-sm font-medium text-gray-700">Konkurs</label>
            <select wire:model.live="contest_id" id="contest"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @foreach ($allContests as $contest)
                    <option value="{{ $contest->id }}">{{ $contest->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Przełącznik Typu Rankingu -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Typ Rankingu</label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <button wire:click="$set('selectRank', 'individual')"
                    class="relative inline-flex items-center justify-center px-4 py-2 rounded-l-md border text-sm font-medium {{ $selectRank === 'individual' ? 'bg-ctf-red-900 text-white border-ctf-red-900 z-10' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                    Indywidualny
                </button>
                <button wire:click="$set('selectRank', 'team')"
                    class="-ml-px relative inline-flex items-center justify-center px-4 py-2 border text-sm font-medium {{ $selectRank === 'team' ? 'bg-ctf-red-900 text-white border-ctf-red-900 z-10' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                    Drużynowy
                </button>
                <button wire:click="$set('selectRank', 'school')"
                    class="-ml-px relative inline-flex items-center justify-center px-4 py-2 rounded-r-md border text-sm font-medium {{ $selectRank === 'school' ? 'bg-ctf-red-900 text-white border-ctf-red-900 z-10' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                    Szkolny
                </button>
            </div>
        </div>
    </div>

    <!-- TABELA WYNIKÓW -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        #</th>

                    @if ($selectRank === 'individual')
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Użytkownik</th>
                        <th scope="col"
                            class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Szkoła</th>
                        <th scope="col"
                            class="hidden lg:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Drużyna</th>
                    @elseif ($selectRank === 'team')
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Drużyna</th>
                    @else
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Szkoła</th>
                    @endif

                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Punkty</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($allResults as $result)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $result->rank }}</td>

                        @if ($selectRank === 'individual')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $result->user->name ?? 'Brak danych' }}</td>
                            <td
                                class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $result->user->school->name ?? 'Brak' }}</td>
                            <td
                                class="hidden lg:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $result->user->team->name ?? 'Brak' }}</td>
                        @elseif ($selectRank === 'team')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $result->team_name ?? 'Brak danych' }}</td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $result->school_name ?? 'Brak danych' }}</td>
                        @endif

                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-ctf-red-900">
                            {{ round($result->total_points, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                            Brak wyników do wyświetlenia dla wybranych kryteriów.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
