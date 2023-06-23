<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Overzicht:') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-11/12 m-5 ml-10">
                    @foreach($users as $key => $data)
                        @if (auth()->user()->id != $data->id)
                            <label for="{{ $data->name }}" class="text-l font-extrabold w-2/12 inline-block">{{ $data->name }}</label>
                            <label for="{{ $data->email }}" class="text-l font-extrabold w-4/12 inline-block">{{ $data->email }}</label>
                            <form class="inline-block w-5/12" method="GET" action ="/userUpdate/{{ $data->id }}">
                                <label for="{{ $data->role_id }}" class="text-l font-extrabold w-5/12 inline-block">
                                    <select name="role_id" class="border border-gray-300 rounded-md p-1 w-11/12">
                                        <option value="1"{{ $data->role_id == 1 ? ' selected' : '' }}>Admin</option>
                                        <option value="2"{{ $data->role_id == 2 ? ' selected' : '' }}>Gebruiker</option>
                                        <option value="3"{{ $data->role_id == 3 ? ' selected' : '' }}>Bedrijfsaccount</option>
                                    </select>
                                </label>
                                <button type="submit" class="inline-block w-1/12">Update</button>
                            </form>
                            <a href="/gebruiker/{{ $data->id }}" class="text-l font-extrabold text-red-500 dark:text-white w-1/12 hover:text-black">Delete</a><br>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>