<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left mt-4">
            {{ __('Evenementen') }}
        </h2>
        <button class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-right border-solid border-black border-2 rounded-lg p-3 bg-cyan-300">
            {{ __('Aanmaken Evenementen') }}
        </button>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action ="/event/create">
                    @csrf
                    <div class="w-4/5 m-5">
                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl">Name:</p>
                        <input type="text" name="name" placeholder="Enter name here..." class="bg-transparent mx-auto border-b-2 w-9/12 h-12 text-2xl outline-none"><br>

                        <p class="inline-block w-2/12 text-center font-bold m-5 text-2xl align-top">Description:</p>
                        <textarea rows="4" cols="50" name="description" placeholder="Enter description here..."  class="bg-transparent mx-auto border-b-2 w-9/12 h-w-3.5 text-2xl outline-none"></textarea><br>
                        StartDate: <input type="datetime-local" value="" id="startDate" name="startDate" min="{{Carbon\Carbon::now()->format("Y-m-d")}}T{{Carbon\Carbon::now()->format("H:i")}}" required><br>
                        EndDate: <input type="datetime-local" value="" id="endDate" name="endDate" required><br>
                        <button type="submit" class="uppercase bg-blue-500 text-gray-100 text-lg w-1/5 m-10 font-extrabold py-4 px-8 rounded-3xl hover:bg-sky-700">Submit</button>

                        <script>
                            let txtStartDate = document.getElementById("startDate");
                            let txtEndDate = document.getElementById("endDate");

                            if (txtStartDate) {
                                txtStartDate.addEventListener("change", (event) => {
                                    console.log(txtStartDate.value);
                                    let date = new Date(txtStartDate.value);
                                    console.log(date.toString())
                                    date.setDate(date.getDate() + 3);
                                    console.log(date.toString())

                                    txtEndDate.min = date.toISOString().split(".")[0];
                                    console.log(txtEndDate.min);
                                });
                            }
                        </script>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
