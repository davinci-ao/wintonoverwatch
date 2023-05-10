<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Company') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action ="/company/create">
                    @csrf
                    Name: <input type="text" name="name" required><br>
                    <button type="submit" style="padding: 5px; border-width: 2px;">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
