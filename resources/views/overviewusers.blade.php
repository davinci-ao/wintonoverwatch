<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Overzicht:') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action ="{{ route('users.deleteSelected') }}">
                    @csrf
                    @method('DELETE')
                    <div class="w-11/12 m-5 ml-10">
                        @foreach($users as $key => $data)                    
                            @if (auth()->user()->id != $data->id)
                                <input type="checkbox" name="selectedIds[]" value="{{$data->id}}" class="mb-3 mt-2">
                                <label for="{{$data->name}}" class="text-l font-extrabold w-2/12 inline-block"> {{$data->name}} </label>
                                <label for="{{$data->name}}" class="text-l font-extrabold w-4/12 inline-block"> {{$data->email}} </label>
                                <label for="{{$data->name}}" class="text-l font-extrabold w-3/12 inline-block"> {{$data->role_id}} </label>
                                <a href="/gebruiker/{{$data->id}}" class="text-l font-extrabold text-red-500 dark:text-white w-2/12">Delete</a><br>
                            @endif
                        @endforeach
                        
                        

                        <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-1/5 m-10 font-extrabold py-4 px-8 rounded-3xl hover:bg-sky-700">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>