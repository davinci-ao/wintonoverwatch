<x-app-layout>
    <x-slot name="header">
        @foreach ($event as $key => $data)
            @auth
            <!-- role_id checks if the user is an admin(1)/user(2)/company(3) -->
            @if(auth()->user()->role_id == 1)
                <a href="/eventcompanies/{{$data->id}}" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700">
                    {{ __('Voeg bedrijf toe') }}
                </a>
                @endif
                <!-- checks if the user is an admin or regular user and checks if the user has joined the event -->
                @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                    {{$present = true}}
                    @foreach($participants as $number => $student)
                        @if($student->user_id == auth()->user()->id && $student->event_id == $data->id)
                            {{$present = false}}
                        @endif
                    @endforeach
                    @if($present == true)
                        <a href="/event/signup/{{$data->id}}" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700">
                            {{ __('Inschrijven') }}
                        </a>
                    @elseif($present == false)
                        <a href="/event/signout/{{$data->id}}" class="uppercase bg-red-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-red-600">
                            {{ __('Uitschrijven') }}
                        </a>
                    @endif
                @endif
                <!-- role_id checks if the user is an admin(1)/user(2)/company(3) -->
                @if(auth()->user()->role_id == 3)
                <form action="{{ route('event.join', ['id' => $data->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700"> join event</button>
                </form>
                @endif  
            @endauth
            
        @endforeach
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-b-20">
                @foreach ($event as $key => $data)
                <div class="relative w-full h-64 flex flex-col justify-end items-center" style="background-image:url({{ Storage::url($data->image) }})">
                    <div class="absolute bottom-0 w-full h-16 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 w-full h-16 flex justify-center items-center">
                        <h1 class="text-white font-extrabold text-center text-4xl" style="text-shadow: 0px 3px 1px rgba(0, 0, 0, 0.5);">{{$data->title}}</h1>
                    </div>
                </div>
                @auth
                    <!-- role_id checks if the user is an admin(1)/user(2)/company(3) -->
                    @if(auth()->user()->role_id == 1)
                        <div class="bg-gray-100 px-4 py-1 flex justify-end">
                            <a href="{{ route('eventEdit', $data->id) }}" class="uppercase bg-blue-500 text-gray-300 hover:text-gray-900 rounded-3xl font-extrabold px-3"> Edit </a>
                        </div>
                    @endif
                @endauth
                <div class="w-7/12 border-r-2 p-2 inline-block">
                    <h1 class="text-lg w-fit font-extrabold ml-5">Description:</h1>
                    <h2 class="font-semibold text-l text-gray-800 dark:text-gray-200 leading-tight m-5">
                    {{$data->description}}
                    </h2>
                </div>
                <div class="w-4/12 inline-block align-top">
                    <h1 class="text-lg w-fit font-extrabold ml-5 mt-5">Start date: {{\Carbon\Carbon::parse($data->startDate)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($data->startDate)->format('H:i')}}</h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5">End date: {{\Carbon\Carbon::parse($data->endDate)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($data->endDate)->format('H:i')}}</h1>
                    <h1 class="text-lg w-fit font-extrabold ml-5">Location: {{$data->location}}</h1>
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
                                @auth
                                <a href="/company/{{$data->id}}" class="border border-gray-500 bg-blue-500 text-m text-white basis-full py-2 px-20 rounded-3xl transition hover:bg-sky-700">Info</a>
                                @endauth
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
