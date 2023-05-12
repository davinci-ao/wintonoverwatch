<x-app-layout>
    @foreach ($company as $key => $data)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-b-20">
                <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight mt-4 text-center">
                {{$data->name}}
                </h2>
                <div class="w-3/5 p-2 inline-block">
                    <h1 class="text-lg w-fit font-extrabold ml-5">Description:</h1>
                    <h2 class="font-semibold text-l text-gray-800 dark:text-gray-200 leading-tight m-5">
                    My description here.
                    </h2>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>