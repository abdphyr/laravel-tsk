<x-dashboard>
    <div class='flex items-center justify-center from-teal-100'>
        <div class='w-full max-w-lg px-5 py-4 mx-auto bg-white rounded-lg shadow-xl'>
            <div class='max-w-md mx-auto space-y-6'>
                <form action="{{ route('answers.store', ['application' => $application]) }}" method="POST">
                    @csrf
                    <h2 class="text-2xl font-bold text-center mb-3">Answer application</h2>
                    <div class="border-b mb-3"></div>
                    <label class="uppercase text-sm font-bold opacity-70">Answer</label>
                    <textarea name="body" type="text" rows="5"
                        class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none"></textarea>
                    <div class="flex items-center justify-around">
                        <input type="submit"
                            class="py-2 px-6 my-2 bg-emerald-500 text-white font-medium rounded hover:bg-emerald-400 cursor-pointer ease-in-out duration-300"
                            value="Send">
                        <a href="{{ route('manager') }}"
                            class="py-2 px-6 my-2 bg-red-500 text-white font-medium rounded hover:bg-red-400 cursor-pointer ease-in-out duration-300">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard>
