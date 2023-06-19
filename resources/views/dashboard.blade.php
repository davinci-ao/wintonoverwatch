<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Evenementen') }}
        </h2>
        @auth
            @if(auth()->user()->role_id == 1)
                <a href="/eventform" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700">
                    {{ __('Aanmaken Evenementen') }}
                </a>
            @endif
        @endauth
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg overflow-hidden">
                @foreach ($events as $key => $data)
                    @if($data->visible == 1 || (auth()->check() && auth()->user()->role_id == 1))
                        <a href="/event/{{$data->id}}" class="block">
                        <div class=" w-full h-full lg:p-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700 lg:flex w-full h-full transform origin-top-left scale-100 hover:scale-105 transition-transform duration-300">
                            <div class="w-3/12 inline-block mr-5 justify-items-start float-left">
                                <img src="{{ Storage::url($data->image) }}" class="w-72 h-64" alt="">                         
                            </div>    
                            <div class="w-8/12 inline-block">
                                <h1 class="text-5xl font-bold text-gray-900 dark:text-white font-extrabold">
                                    {{Str::title($data->title)}}
                                </h1>

                                <h1 class="text-xl text-gray-900 dark:text-white font-extrabold w-full inline-block">
                                    Date: {{\Carbon\Carbon::parse($data->startDate)->format('d-m-Y H:i')}} -> {{\Carbon\Carbon::parse($data->endDate)->format('d-m-Y H:i')}}
                                </h1>
                                <h1 class="text-xl text-gray-900 dark:text-white font-extrabold w-full inline-block">
                                    Location: {{$data->location}}
                                </h1>
                                <p class="mt-2 mb-3 text-gray-500 dark:text-gray-400 leading-relaxed">
                                    {{$data->description}}
                                </p>
                                
                            </div>
                        </div>
                        </a>
                            <div class="bg-white px-4 py-1 flex justify-end relative z-0">
                                @auth
                                    @if(auth()->user()->role_id == 1)
                                        <a href="{{ route('eventEdit', $data->id) }}" class="uppercase bg-blue-500 text-gray-300 hover:text-gray-900 rounded-3xl font-extrabold px-3"> Edit </a>
                                    @endif
                                @endauth
                            </div>

                            <div class="bg-gray-100 px-4 py-1 flex justify-end relative z-0">
                
                            </div>

                        @elseif (!auth()->check() && $data->visible == 1)
                            <a href="/event/{{$data->id}}" class="block">
                            <div class=" w-full h-full lg:p-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700 lg:flex w-full h-full transform origin-top-left scale-100 hover:scale-105 transition-transform duration-300">
                                <div class="w-3/12 inline-block mr-5 justify-items-start float-left">
                                    <img src="{{ Storage::url($data->image) }}" alt="">
                                </div>    
                                <div class="w-8/12 inline-block">
                                    <h1 class="text-5xl font-bold text-gray-900 dark:text-white font-extrabold">
                                    {{Str::title($data->title)}}
                                    </h1>

                                    <h1 class="text-xl text-gray-900 dark:text-white font-extrabold w-full inline-block">
                                        Date: {{\Carbon\Carbon::parse($data->startDate)->format('d-m-Y H:i')}} -> {{\Carbon\Carbon::parse($data->endDate)->format('d-m-Y H:i')}}
                                    </h1>
                                    <h1 class="text-xl text-gray-900 dark:text-white font-extrabold w-full inline-block">
                                        Location: {{$data->location}}
                                    </h1>
                                    <p class="mt-2 mb-3 text-gray-500 dark:text-gray-400 leading-relaxed">
                                        {{ Str::limit($data->description, 400) }}
                                    </p>
                                    
                                </div>
                            </div>
                            </a>
                                <div class="bg-white px-4 py-1 flex justify-end relative z-0">
                                   
                                </div>
                                <div class="bg-gray-100 px-4 py-1 flex justify-end relative z-0">
                    
                                </div>
                    @endif
                    
                    
                @endforeach
    
            </div>
        </div>
    </div>
</x-app-layout>
