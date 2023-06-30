<x-app-layout>
    @foreach ($company as $key => $data)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
        </h2>
        @auth
            @if(auth()->user()->role_id == 1)
            <a href="/companyusers/{{$data->id}}" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700">
                    {{ __('Voeg gebruiker toe') }}
            </a>
            @endif
            @if(auth()->user()->role_id == 1 && $companyusers == null)
            <a href="{{ route('companyedit', $data->id) }}" class="uppercase bg-blue-500 text-gray-300 hover:text-gray-900 rounded-3xl float-right font-extrabold px-3"> Edit </a>
            @elseif ($companyusers != null)
                @if($companyusers->user_id == auth()->user()->id)
                <a href="{{ route('companyedit', $data->id) }}" class="uppercase bg-blue-500 text-gray-300 hover:text-gray-900 rounded-3xl float-right font-extrabold px-3"> Edit </a>
                @endif
            @endif
        @endauth
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-b-20">
                <div class="relative w-full h-64 flex flex-col items-center justify-center absolute bg-cover items-center bg-center" style="background-image:url({{ Storage::url($data->image) }})">
                    <div class="absolute bottom-0 w-full h-16 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 w-full h-16 flex justify-center items-center">
                        <h1 class="text-white font-extrabold text-center text-4xl" style="text-shadow: 0px 3px 1px rgba(0, 0, 0, 0.5);">{{$data->name}}</h1>
                    </div>
                </div>
                <div class="w-7/12 border-r-2 p-2 inline-block">
                    <h1 class="text-lg w-fit font-extrabold ml-5">Omschrijving:</h1>
                    <h2 class="font-semibold text-l text-gray-800 dark:text-gray-200 leading-tight m-5">
                    {{$data->long_description}}
                    </h2>
                </div>
                <div class="w-4/12 inline-block align-top">
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-3 inline-block">Naam: </h1> <h1 class="inline-block">{{ $data->name }}</h1><br>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-3 inline-block">Stagesoort: </h1> <h1 class="inline-block">{{ $data->internship }}</h1><br>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-3 inline-block">Programmeertalen: </h1> <h1 class="inline-block">{{ $data->languages }}</h1><br>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-3 inline-block">Contactpersoon: </h1> <h1 class="inline-block">{{$data->contact}}</h1><br>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-3 inline-block">Mail: </h1> <h1 class="inline-block">{{$data->mail}}</h1><br>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-3 inline-block">Telefoonnummer: </h1> <h1 class="inline-block">{{$data->phone_number}}</h1><br>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-3 inline-block">Locatie: </h1> <h1 class="inline-block">{{$data->location}}</h1><br>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-3 inline-block">Website: <a href="{{$data->website_link}}" target="_blank" class="text-blue-500 underline">Click</a></h1>

                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>
