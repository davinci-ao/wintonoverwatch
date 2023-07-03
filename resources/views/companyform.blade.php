<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Company') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action ="/company/create" enctype="multipart/form-data">
                    @csrf
                    <div class="w-4/5 m-5">
                        <p class="inline-block w-3/12 text-center font-bold m-5 text-2xl">Naam:</p>
                        <input type="text" name="name" placeholder="Enter name here..." class="bg-transparent mx-auto border-b-2 w-8/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-3/12 text-center font-bold m-5 text-2xl">Samenvatting:</p>
                        <input type="text" name="short_description" placeholder="Enter Summary here..." class="bg-transparent mx-auto border-b-2 w-8/12 h-12 text-2xl outline-none" required><br>

                        <p for="long_description" class="inline-block w-3/12 text-center font-bold m-5 text-2xl align-top">Omschrijving:</p>
                        <textarea rows="4" cols="50" id="long_description" name="long_description" placeholder="Enter description here..."  class="bg-transparent mx-auto border-b-2 w-8/12 h-w-3.5 text-2xl outline-none" required></textarea><br>

                        <p class="inline-block w-3/12 text-center font-bold m-5 text-2xl">Contactpersoon:</p>
                        <input type="text" name="contact" placeholder="Enter contact here..." class="bg-transparent mx-auto border-b-2 w-8/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-3/12 text-center font-bold m-5 text-2xl">Mail:</p>
                        <input type="text" name="mail" placeholder="Enter mail here..." class="bg-transparent mx-auto border-b-2 w-8/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-3/12 text-center font-bold m-5 text-2xl">Telefoonnummer:</p>
                        <input type="text" name="phone_number" placeholder="Enter phone number here..." class="bg-transparent mx-auto border-b-2 w-8/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-3/12 text-center font-bold m-5 text-2xl">Website:</p>
                        <input type="text" name="website_link" placeholder="Enter website here..." class="bg-transparent mx-auto border-b-2 w-8/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-3/12 text-center font-bold m-5 text-2xl">Locatie:</p>
                        <input type="text" name="location" placeholder="Enter location here..." class="bg-transparent mx-auto border-b-2 w-8/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-3/12 text-center font-bold m-5 text-2xl">Stagesoort:</p>
                        <input type="text" name="internship" placeholder="Enter intership type here..." class="bg-transparent mx-auto border-b-2 w-8/12 h-12 text-2xl outline-none" required><br>

                        <p class="inline-block w-3/12 text-center font-bold m-5 text-2xl">Programmeertalen:</p>
                        <input type="text" name="languages" placeholder="Enter Summary here..." class="bg-transparent mx-auto border-b-2 w-8/12 h-12 text-2xl outline-none" required><br>

                        <label class="block mb-4">
                        <span class="sr-only">Kies een foto</span>
                        <input type="file" name="image"
                            class="block w-full ml-10 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                        @error('image')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-1/5 m-10 font-extrabold py-4 px-8 rounded-3xl hover:bg-sky-700">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
