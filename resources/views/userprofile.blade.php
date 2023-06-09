<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Profiel') }}
        </h2>
        @if(auth()->user()->role_id == 1 || $data->userid == auth()->user()->id)
        <a href="/profile/edit/{{$data->userid}}" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700">
            {{ __('Bewerken') }}
        </a>
        @endif
    </x-slot>
        


    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-4/5 m-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg w-full m-auto">
            <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight mt-4 text-center">
                {{$info->name}}
                </h2>
                <div class="w-4/12">
                    <img src="{{ Storage::url($info->profile_photo_path) }}" alt="" class="ml-2 w-52 rounded-lg float-left">
                </div>
                <div class="w-5/12  p-2 inline-block">
                    <h1 class="text-lg w-fit font-extrabold ml-5">Description:</h1>
                    <h2 class="font-semibold text-l text-gray-800 dark:text-gray-200 leading-tight m-5">
                    {{$data->description}}
                    </h2>
                </div>
                <div class="w-3/12 border-l-2 inline-block align-top">
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Status: {{$data->status}}</h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Leerjaar: {{$data->year}}</h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Telefoonnummer: {{$data->phone_number}}</h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Github: <a href="{{$data->github_link}}" target="_blank" class="text-blue-500 underline">Click</a></h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Email: {{$info->email}}</h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
