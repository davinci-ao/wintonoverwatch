<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Bedrijven:') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action ="/event/company/add">
                    @csrf
                    <div class="w-4/5 m-5 ml-10">
                        @foreach($companies as $key => $data)
                        <input type="checkbox" id="{{$data->name}}" name="{{$key}}" value="{{$data->id}}" class="mb-3 mt-2"
                            @foreach($addedCompanies as $info => $check)
                                @if ($check->event_id == $eventid)
                                    @if($check->company_id == $data->id) checked @endif
                                @endif
                            @endforeach>
                        <label for="{{$data->name}}" class="text-center font-bold m-5 ml-2 text-2xl align-top" >{{$data->name}}</label><br>
                        @endforeach

                        <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-1/5 m-10 font-extrabold py-4 px-8 rounded-3xl hover:bg-sky-700">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>