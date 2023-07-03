<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">

        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action ="/profile/update">
                    @csrf
                    <div class="w-4/5 m-5">
                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl align-top">Omschrijving:</p>
                        <textarea rows="4" cols="50" type="text" name="description" value="" class="bg-transparent mx-auto border-b-2 w-9/12 h-w-3.5 text-2xl outline-none" required>{{ $data->description }}</textarea><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Status:</p>
                        <input type="text" name="status" value="{{ $data->status }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Jaar:</p>
                        <input type="number" name="year" value="{{ $data->year }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Telefoonnummer:</p>
                        <input type="number" name="phone_number" value="{{ $data->phone_number }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Github:</p>
                        <input type="text" name="github_link" value="{{ $data->github_link }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-1/5 m-10 font-extrabold py-4 px-8 rounded-3xl hover:bg-sky-700">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
