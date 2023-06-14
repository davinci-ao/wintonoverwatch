<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            Deelnemers
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-b-20">
                <div class="relative w-full flex flex-col justify-center absolute">
                    <div class="absolute bottom-0 w-full h-16 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 w-full h-16 flex justify-center items-center">
                    </div>
                </div>
                <div class="border-b-2 border-black">
                    <div class="w-4/12 inline-block">
                        <p class="text-xl w-fit font-extrabold ml-5 text-gray-900 dark:text-white">Naam:</p>
                    </div>
                    <div class="text-xl w-7/12 inline-block font-extrabold align-top">
                        <p class="font-extrabold text-gray-900 dark:text-white">Bedrijven:</p>
                    </div>
                </div>
                @foreach($select as $key => $data)
                    @foreach($participants as $number => $student)
                        @if($student->id == $data->user_id)
                            <div class="w-4/12 inline-block">
                                <p class="text-lg w-fit font-extrabold ml-5 dark:text-white">{{$student->name}}</p>
                            </div>
                            <div class="w-7/12 inline-block align-top">
                                @foreach($selectcompany as $keys => $info)
                                    @foreach($companies as $business => $company)
                                        @if($info->company_id == $company->id && $info->user_id == $student->id)
                                            <p class="text-lg float-left font-extrabold dark:text-white mr-2">{{$company->name}}.</p>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>