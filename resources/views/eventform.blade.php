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
                <form method="POST" action="/event/create">
                    @csrf
                    Name: <input type="text" name="name" required><br>
                    Description: <input type="text" name="description" required><br>
                    StartDate: <input type="datetime-local" value="" id="startDate" name="startDate" min="{{Carbon\Carbon::now()->format("Y-m-d")}}T{{Carbon\Carbon::now()->format("H:i")}}" required><br>
                    EndDate: <input type="datetime-local" value="" id="endDate" name="endDate" required><br>
                    <button type="submit" style="padding: 5px; border-width: 2px;">Submit</button>

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
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
