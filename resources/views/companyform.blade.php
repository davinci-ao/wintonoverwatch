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
                    <div class="w-4/5 m-5">
                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Name:</p> 
                        <input type="text" name="name" placeholder="Enter name here..." class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-1/5 m-10 font-extrabold py-4 px-8 rounded-3xl hover:bg-sky-700">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
