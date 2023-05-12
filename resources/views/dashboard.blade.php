<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Evenementen') }}
        </h2>
        <a href="/eventform" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700">
            {{ __('Aanmaken Evenementen') }}
        </a>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($events as $key => $data)
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <h1 class="text-2xl font-medium text-gray-900 dark:text-white font-extrabold">
                    {{$data->title}}
                    </h1>

                    <h1 class="text-xl text-gray-900 dark:text-white font-extrabold w-1/12 inline-block">Date: </h1>
                    <h1 class="mt-8 text-xl font-medium text-gray-900 dark:text-white w-6/12 inline-block">{{\Carbon\Carbon::parse($data->startDate)->format('H:i d/m/Y')}} -> {{\Carbon\Carbon::parse($data->startDate)->format('H:i d/m/Y')}}</h1>
                    <p class="mt-6 mb-3 text-gray-500 dark:text-gray-400 leading-relaxed">
                    {{$data->description}}
                    </p>

                    <a href="/event/{{$data->id}}" class="border border-gray-500 bg-blue-500 text-m text-white py-2 px-2 rounded-3xl transition hover:bg-sky-700">Show event</a>

                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
