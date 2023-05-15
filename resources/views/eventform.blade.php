<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Evenementen') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-4/5 m-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg w-full m-auto">
                <form method="POST" action ="/event/create">
                    @csrf
                    <div class="w-4/5 m-5">
                        <label for="name" class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Name:</label> 
                        <input type="text" name="name" id="name" placeholder="Enter name here..." class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <label for="location" class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Location:</label> 
                        <input type="text" name="location" id="location" placeholder="Enter location here..." class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none" required><br>

                        <label for="description" class="inline-block w-2/12 text-center font-bold m-5 text-2xl align-top">Description:</label> 
                        <textarea rows="4" cols="50" id="description" name="description" placeholder="Enter description here..."  class="bg-transparent mx-auto border-b-2 w-9/12 h-w-3.5 text-2xl outline-none" required></textarea><br>
                        
                        <label for="startDate" class="inline-block w-2/12 text-center font-bold m-5 text-2xl align-top" >StartDate:</label>  
                        <input type="datetime-local" name="startDate" type="datetime-local" value="" id="startDate" name="startDate" min="{{Carbon\Carbon::now()->format('Y-m-d')}}T{{Carbon\Carbon::now()->format('H:i')}}" class="bg-transparent mx-auto border-b-2 h-12 text-2xl outline-none" required><br>

                        <label for="endDate" class="inline-block w-2/12 text-center font-bold m-5 text-2xl align-top">EndDate:</label>
                        <input type="datetime-local" id="endDate" name="endDate" class="bg-transparent mx-auto border-b-2 h-12 text-2xl outline-none" required>
                    </div>

                    <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-1/5 m-10 font-extrabold py-4 px-8 rounded-3xl hover:bg-sky-700">Submit</button>

                    <script>
                        let txtStartDate = document.getElementById("startDate");
                        let txtEndDate = document.getElementById("endDate");

                        if (txtStartDate) {
                            txtStartDate.addEventListener("change", () => {
                                console.log(txtStartDate.value);
                                let date = new Date(txtStartDate.value);
                                console.log(date.toString())
                                date.setDate(date.getDate());
                                console.log(date.toString())

                                txtEndDate.min = date.toISOString().split(".")[0];
                                console.log(txtEndDate.min);
                            });
                        }
                    </script>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
