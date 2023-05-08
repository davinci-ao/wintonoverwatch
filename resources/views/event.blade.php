<x-app-layout>
    <x-slot name="header">
        @foreach ($event as $key => $data)
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-4">
            {{$data->title}}
        </h2>
        <h2 class="font-semibold text-l text-gray-800 dark:text-gray-200 leading-tight mt-4">
            {{$data->description}}
        </h2>
        @endforeach
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($select as $key => $info)
                    @foreach ($company as $keys => $data)
                        @if ($data->id == $info->company_id)
                        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                            <h1 class="mt-4 text-2xl font-medium text-gray-900 dark:text-white">
                            {{$data->name}}
                            </h1>

                        </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
