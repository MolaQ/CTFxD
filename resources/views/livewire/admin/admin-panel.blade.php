<!-- resources/views/livewire/admin/admin-panel.blade.php -->

<div>
    <h2 class="text-3xl font-bold mb-6 text-[#880000]">Witaj w panelu administracyjnym</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded shadow border border-gray-200">
            <h3 class="text-xl font-semibold mb-4">Liczba szkół</h3>
            <p class="text-4xl font-bold text-black">{{ $schoolsCounter }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow border border-gray-200">
            <h3 class="text-xl font-semibold mb-4">Nowe szkoły (7 dni)</h3>
            <p class="text-4xl font-bold text-black">{{ $newSchoolsCounter }}</p>
        </div>
    </div>

    <p class="mt-8 text-gray-700">Zarządzaj szkołami i innymi zasobami w panelu administracyjnym.</p>
</div>
