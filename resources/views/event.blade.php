<x-app-layout>
    <x-slot name="header">
        @foreach ($event as $key => $data)
            @php
                $studentnumber = 0;
            @endphp
            @foreach($participants as $number => $student)
                @php
                    $studentnumber = $studentnumber + 1;
                @endphp
            @endforeach
            @auth
            <!-- role_id checks if the user is an admin(1)/user(2)/company(3) -->
            @if(auth()->user()->role_id == 1)
                <a href="/eventcompanies/{{$data->id}}" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700">
                    {{ __('Voeg bedrijf toe') }}
                </a>
                <a href="/eventparticipants/{{$data->id}}" class="border-2 p-2 border-black rounded-2xl font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-2">Deelnemers: {{$studentnumber}}</a>
            @endif
                <!-- checks if the user is an admin or regular user and checks if the user has joined the event -->
                @if(auth()->user()->role_id == 2)
                @php 
                    $present = true
                @endphp
                    @foreach($participants as $number => $student)
                        @if($student->user_id == auth()->user()->id && $student->event_id == $data->id)
                        @php
                            $present = false
                        @endphp
                            
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
                    <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-fit font-extrabold py-3 px-6 rounded-3xl float-right hover:bg-sky-700">Woon event bij</button>
                </form>
                @endif  
            @endauth
            
        @endforeach
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-b-20">
            @foreach ($event as $key => $data)
                <div class="relative w-full h-64 flex flex-col items-center justify-center absolute bg-cover items-center bg-center" style="background-image:url({{ Storage::url($data->image) }})">
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
                    <h1 class="text-lg w-fit font-extrabold ml-5">Descriptie:</h1>
                    <h2 class="font-semibold text-l text-gray-800 dark:text-gray-200 leading-tight m-5">
                    {{$data->description}}
                    </h2>
                </div>
                <div class="w-4/12 inline-block align-top">
                    <h1 class="text-lg font-extrabold ml-5 mt-5 w-3/12 inline-block">
                        Start datum: 
                    </h1>
                    <h1 class="text-lg font-extrabold w-6/12 inline-block">
                    {{\Carbon\Carbon::parse($data->startDate)->format('d-m-Y')}} {{\Carbon\Carbon::parse($data->startDate)->format('H:i')}}
                    </h1><br>
                    <h1 class="text-lg font-extrabold ml-5 w-3/12 inline-block">
                        Eind datum: 
                    </h1>
                    <h1 class="text-lg font-extrabold w-6/12 inline-block">
                        {{\Carbon\Carbon::parse($data->endDate)->format('d-m-Y')}} {{\Carbon\Carbon::parse($data->endDate)->format('H:i')}}
                    </h1>
                    <h1 class="text-lg font-extrabold ml-5 w-3/12 inline-block">
                        Locatie: 
                    </h1>
                    <h1 class="text-lg font-extrabold w-6/12 inline-block">
                    {{$data->location}}
                    </h1>
                </div>
                @endforeach
                <div class="w-full mx-auto py-2 ">
                    <div class="border-b border-grey-500 mt-5 pl-4 w-full">
                        <div class="w-3/12 inline-block">
                            <h1 class="my-1 text-l font-extrabold text-gray-900 dark:text-white">
                                Bedrijfsnaam:
                            </h1>                               
                        </div>
                        <div class="w-7/12 inline-block">
                            <h1 class="my-1 text-l font-extrabold text-gray-900 dark:text-white">
                                Wat wij komen doen:
                            </h1>
                        </div>
                        <div class="w-1/12 inline-block">
                            <h1>
                                @auth
                                    @if(auth()->user()->role_id == 1)
                                        <h1 class="my-1 text-l font-extrabold text-gray-900 dark:text-white">
                                            edit
                                        </h1>
                                    @endif
                                    @if(auth()->user()->role_id == 2)
                                        <h1 class="my-1 text-l font-extrabold text-gray-900 dark:text-white">
                                            Inschrijven
                                        </h1>
                                    @endif
                                @endauth
                            </h1>
                        </div>
                    </div>
                    @foreach ($select as $key => $info)
                        @foreach ($company as $keys => $data)
                                            @php 
                                                $inCompany = true
                                            @endphp
                            @if ($data->id == $info->company_id)
                            <div class="pl-4 w-full">
                                <div class="w-3/12 inline-block">
                                    <h1 class="my-1 text-l font-extrabold text-gray-900 dark:text-white">
                                        @auth
                                            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                                                <a href="/company/{{$data->id}}" class="my-1 text-l font-extrabold text-gray-900 dark:text-white">{{$data->name}}</a>
                                            @endif
                                            @if (auth()->user()->role_id == 2)
                                                <h1 class="my-1 text-l font-extrabold text-gray-900 dark:text-white">
                                                    {{$data->name}}
                                                </h1>   
                                            @endif
                                        @endauth
                                        @guest
                                            <h1 class="my-1 text-l font-extrabold text-gray-900 dark:text-white">
                                                {{$data->name}}
                                            </h1>   
                                        @endguest
                                    </h1>                               
                                </div>
                                <div class="w-7/12 inline-block">
                                    <h1>
                                        Wat wij komen doen:
                                    </h1>
                                </div>
                                <div class="w-1/12 inline-block">
                                    @auth
                                    @php 
                                        $inCompany = true
                                    @endphp
                                        @foreach($business as $businessKey => $businessData)
                                            @if($businessData->user_id == auth()->user()->id && $businessData->event_id == $info->event_id && $businessData->company_id == $info->company_id)
                                            @php
                                                $inCompany = false
                                            @endphp
                                                
                                            @endif
                                        @endforeach
                                        @if(auth()->user()->role_id == 2)
                                            @if ($present != true)
                                                @if($inCompany == true)
                                                    <form method="POST" action="/event/signupToCompany">
                                                        @csrf
                                                        <input type="hidden" name="companyId" value="{{ $info->company_id }}">
                                                        <input type="hidden" name="eventId" value="{{ $info->event_id }}">
                                                        <button type="submit" class="text-blue-500 hover:text-red-500 underline">Inschrijven</button>
                                                    </form>
                                                @elseif($inCompany == false)
                                                    <form method="POST" action="/event/signoutOnCompany">
                                                        @csrf
                                                        <input type="hidden" name="companyId" value="{{ $info->company_id }}">
                                                        <input type="hidden" name="eventId" value="{{ $info->event_id }}">
                                                        <button type="submit">Uitschrijven</button>
                                                    </form>
                                                @endif
                                            @endif
                                            @endif
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
