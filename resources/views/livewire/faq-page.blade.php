<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <!-- NAGŁÓWEK I WYSZUKIWARKA -->
    <header class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
            Często Zadawane Pytania (FAQ)
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
            Znajdź odpowiedzi na najczęściej pojawiające się pytania dotyczące platformy, konkursów i zadań.
        </p>
        <div class="mt-8 max-w-md mx-auto">
            <input wire:model.live.debounce.300ms="search" type="search" placeholder="Czego szukasz?"
                class="block w-full rounded-full border-gray-300 px-5 py-3 text-base text-gray-900 placeholder-gray-500 shadow-sm focus:ring-ctf-red-500 focus:border-ctf-red-500">
        </div>
    </header>

    <!-- LISTA PYTAŃ I ODPOWIEDZI (AKORDEON) -->
    <div class="space-y-4">
        @forelse ($allFaqs as $faq)
            {{-- 
                x-data="{ open: false }" - inicjalizuje stan dla każdego elementu (domyślnie zamknięty)
                @click="open = !open" - przełącza stan przy kliknięciu
                x-show="open" - pokazuje lub ukrywa element
                x-transition - dodaje płynne animacje
            --}}
            <div x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }" class="bg-white shadow-lg rounded-lg overflow-hidden">
                {{-- Pytanie (klikalny nagłówek) --}}
                <dt>
                    <button @click="open = !open"
                        class="w-full flex justify-between items-center text-left text-lg font-medium p-6 hover:bg-gray-50 focus:outline-none focus-visible:ring focus-visible:ring-ctf-red-500 focus-visible:ring-opacity-75">
                        <span class="text-gray-900">{{ $faq->name }}</span>
                        <span class="ml-6 h-7 flex items-center">
                            {{-- Animowana ikona strzałki --}}
                            <svg class="h-6 w-6 transform transition-transform duration-300"
                                :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                </dt>

                {{-- Odpowiedź (rozwijany panel z animacją) --}}
                <dd x-show="open" x-collapse>
                    <div class="p-6 border-t border-gray-200">
                        <p class="text-base text-gray-600">
                            {{ $faq->description }}
                        </p>
                    </div>
                </dd>
            </div>
        @empty
            <div class="text-center py-12">
                <p class="text-lg font-medium text-gray-700">Nie znaleziono pytań pasujących do
                    Twojego zapytania.</p>
                <p class="mt-2 text-sm text-gray-500">Spróbuj użyć innych słów kluczowych.</p>
            </div>
        @endforelse
    </div>

</div>
