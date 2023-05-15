<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Evenementen') }}
        </h2>
        @if(auth()->user()->role_id == 1)
            <a href="/eventform" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700">
                {{ __('Aanmaken Evenementen') }}
            </a>
        @endif
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($events as $key => $data)
                <a href="/event/{{$data->id}}" class="block">
                <div class="lg:p-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 lg:flex">
                    <div class="w-3/12 inline-block mr-5 justify-items-start float-left">
                        <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg" alt="">
                    </div>    
                    <div class="w-8/12 inline-block">
                        <h1 class="text-5xl font-bold text-gray-900 dark:text-white font-extrabold">
                        {{Str::title($data->title)}}
                        </h1>

                        <h1 class="text-xl text-gray-900 dark:text-white font-extrabold w-full inline-block">Date: {{\Carbon\Carbon::parse($data->startDate)->format('H:i d/m/Y')}} -> {{\Carbon\Carbon::parse($data->endDate)->format('H:i d/m/Y')}}</h1>
                        <h1 class="text-xl text-gray-900 dark:text-white font-extrabold w-full inline-block">Location: {{$data->location}}</h1>
                        <p class="mt-2 mb-3 text-gray-500 dark:text-gray-400 leading-relaxed">
                        {{ Str::limit($data->description, 400) }}
                        </p>
                        
                    </div>
                </div>
                </a>
                    @if(auth()->user()->role_id == 1)
                        <div class="bg-gray-100 px-4 py-1 flex justify-end">
                            <a href="{{ route('eventEdit', $data->id) }}" class="text-gray-700 hover:text-gray-900"> Edit </a>
                            </div>
                    @endif
                                
                @endforeach
    
            </div>
        </div>
    </div>
</x-app-layout>
