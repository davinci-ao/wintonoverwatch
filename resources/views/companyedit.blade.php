<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Company') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action ="/{{ $company->id }}">
                    @csrf
                    <div class="w-4/5 m-5">
                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Name:</p> 
                        <input type="text" name="name" value="{{ $company->name }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Summary:</p> 
                        <input type="text" name="short_description" value="{{ $company->short_description }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>
                        
                        <label for="description" class="inline-block w-2/12 text-center font-bold m-5 text-2xl align-top">Description:</label> 
                        <textarea rows="4" cols="50" id="long_description" name="long_description" class="bg-transparent mx-auto border-b-2 w-9/12 h-w-3.5 text-2xl outline-none" required>{{ $company->long_description }}</textarea><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Contact:</p> 
                        <input type="text" name="contact" value="{{ $company->contact }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Mail:</p> 
                        <input type="text" name="mail" value="{{ $company->mail }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Phone:</p> 
                        <input type="text" name="phone_number" value="{{ $company->phone_number }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Website:</p> 
                        <input type="text" name="website_link" value="{{ $company->website_link }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Location:</p> 
                        <input type="text" name="location" value="{{ $company->location }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-1/5 m-10 font-extrabold py-4 px-8 rounded-3xl hover:bg-sky-700">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>