<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Evenementen') }}
        </h2>
        <a href="/eventform" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-right border-solid border-black border-2 rounded-lg p-3 bg-cyan-300">
            {{ __('Aanmaken Evenementen') }}
        </a>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($events as $key => $data)
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                    {{$data->title}}
                    </h1>

                    <h2 classs="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                    Start {{$data->startDate}}, eindigt {{$data->endDate}}
                    </h2>
                    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                    {{$data->description}}
                    </p>

                    <a href="/event/{{$data->id}}">Klik</a>

                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
