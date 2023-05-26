<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Evenementen') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-4/5 m-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg w-full m-auto">
                <form method="POST" action ="/{{ $event->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="w-4/5 m-5">
                        <label for="visible" class="inline-block w-6/12 text-center font-bold text-2xl align-top">Do you want this event to be visible?</label>
                        <input type="checkbox" id="visible" name="visible" value="1" {{ old('visible', $event->visible) ? 'checked' : '' }} class="h-6 w-6"><br>
                        
                        <label for="name" class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Name:</label> 
                        <input type="text" name="name" id="name" value="{{ $event->title }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <label for="location" class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Location:</label> 
                        <input type="text" name="location" id="location" value="{{ $event->location }}" class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <label for="description" class="inline-block w-2/12 text-center font-bold m-5 text-2xl align-top">Description:</label> 
                        <textarea rows="4" cols="50" id="description" name="description" class="bg-transparent mx-auto border-b-2 w-9/12 h-w-3.5 text-2xl outline-none" required>{{ $event->description }}</textarea><br>
                        
                        <label for="startDate" class="inline-block w-2/12 text-center font-bold m-5 text-2xl align-top" >StartDate:</label>  
                        <input type="datetime-local" name="startDate" value="{{ $event->startDate }}" id="startDate" name="startDate" min="{{Carbon\Carbon::now()->format('Y-m-d')}}T{{Carbon\Carbon::now()->format('H:i')}}" class="bg-transparent mx-auto border-b-2 h-12 text-2xl outline-none" required><br>

                        <label for="endDate" class="inline-block w-2/12 text-center font-bold m-5 text-2xl align-top">EndDate:</label>
                        <input type="datetime-local" id="endDate" name="endDate" value="{{ $event->endDate }}" class="bg-transparent mx-auto border-b-2 h-12 text-2xl outline-none" required>
                        
                        <!-- <label class="block mb-4">
                        <span class="sr-only">Choose File</span>
                        <input type="file" name="image" value="{{$event->image}}" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                        @error('image')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <img src="{{ Storage::url($event->image) }}" alt="" class="float-right">
                        </label> -->
                    </div>

                    <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-1/5 m-10 font-extrabold py-4 px-8 rounded-3xl hover:bg-sky-700">Submit</button>

                    <script>
                        let txtStartDate = document.getElementById("startDate");
                        let txtEndDate = document.getElementById("endDate");
                        txtEndDate.min = txtStartDate.value;

                            txtStartDate.addEventListener("change", () => {
                            let date = new Date(txtStartDate.value);
                            date.setDate(date.getDate());
                            date.setMinutes(date.getMinutes() - date.getTimezoneOffset());
                            txtEndDate.min = date.toISOString().split(".")[0];

                        });
                    </script>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
