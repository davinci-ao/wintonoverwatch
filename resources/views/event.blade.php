<x-app-layout>
    <x-slot name="header">
        
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-b-20">
                @foreach ($event as $key => $data)
                <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight mt-4 text-center">
                {{$data->title}}
                </h2>
                <div class="w-3/5 border-r-2 p-2 inline-block">
                    <h1 class="text-lg w-fit font-extrabold ml-5">Descrpition:</h1>
                    <h2 class="font-semibold text-l text-gray-800 dark:text-gray-200 leading-tight m-5">
                    {{$data->description}}
                    </h2>
                </div>
                <div class="w-1/5 inline-block align-top">
                    <h1 class="text-lg w-fit font-extrabold ml-5">Start date:</h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5">End date:</h1>
                </div>
                @endforeach
                <div class="md:grid lg:grid-cols-4 w-5/6 mx-auto py-2">
                    @foreach ($select as $key => $info)
                    @foreach ($company as $keys => $data)
                        @if ($data->id == $info->company_id)
                        <div class=" inline-block p-3 border-2 border-black text-center rounded-3xl h-84 w-60">
                            <img src="https://cdn.pixabay.com/photo/2023/01/18/16/45/dinosaur-7727356_960_720.png" alt="" class="max-w-2xs rounded-lg">
                            <div class="static relative bottom-0 inline-block align-bottom">
                                 <h1 class="my-4 text-l font-extrabold font-medium text-gray-900 dark:text-white">
                                    {{$data->name}}
                                </h1>
                                <a href="/company/{{$data->id}}" class="border border-gray-500 bg-blue-500 text-m text-white basis-full py-2 px-20 rounded-3xl transition hover:bg-sky-700">Info</a>
                            </div>
                           
                        </div>
                        @endif
                    @endforeach
                @endforeach
                </div>                
            </div>
        </div>
    </div>
</x-app-layout>
