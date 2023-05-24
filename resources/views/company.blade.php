<x-app-layout>
    @foreach ($company as $key => $data)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
        </h2>
        <a href="{{ route('companyedit', $data->id) }}" class="uppercase bg-blue-500 text-gray-300 hover:text-gray-900 rounded-3xl float-right font-extrabold px-3"> Edit </a>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-b-20">
                <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight mt-4 text-center">
                {{$data->name}}
                </h2>
                <div class="w-7/12 border-r-2 p-2 inline-block">
                    <h1 class="text-lg w-fit font-extrabold ml-5">Description:</h1>
                    <h2 class="font-semibold text-l text-gray-800 dark:text-gray-200 leading-tight m-5">
                    {{$data->long_description}}
                    </h2>
                </div>
                <div class="w-4/12 inline-block align-top">
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Contactpersoon: {{$data->contact}}</h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Mail: {{$data->mail}}</h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Phone: {{$data->phone_number}}</h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Website: <a href="{{$data->website_link}}" target="_blank" class="text-blue-500 underline">Click</a></h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Location: {{$data->location}}</h1>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>