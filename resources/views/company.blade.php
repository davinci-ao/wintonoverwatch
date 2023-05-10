<x-app-layout>
    @foreach ($company as $key => $data)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{$data->name}}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                Beschrijving:<br>
                Talen:<br>
                Adres:<br>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>