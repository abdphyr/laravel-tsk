<x-dashboard>
    @if (session()->has('error'))
        <div class="flex items-center justify-center">
            <div class="md:w-5/12 flex items-center justify-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5"
                role="alert">
                <strong class="bg-red-800 rounded-full mr-1">
                    <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill="#fff"
                            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                    </svg>
                </strong>
                <span class="block sm:inline">
                    {{ session()->get('error') }}
                </span>
            </div>
        </div>
    @endif
    <div class='flex items-center justify-center from-teal-100'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
            <div class='max-w-md mx-auto space-y-6'>
                <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-2xl font-bold text-center mb-3">Submit your application</h2>
                    <div class="border-b mb-3"></div>
                    <label class="uppercase text-sm font-bold opacity-70">Subject</label>
                    <input name="subject" type="text"
                        class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">

                    <label class="uppercase text-sm font-bold opacity-70">Message</label>
                    <textarea name="message" type="text" rows="5"
                        class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none"></textarea>

                    <label class="uppercase text-sm font-bold opacity-70">File</label>
                    <input name="file" type="file"
                        class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">

                    <input type="submit"
                        class="py-3 px-6 my-2 bg-emerald-500 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300"
                        value="Send">
                </form>

            </div>
        </div>
    </div>
</x-dashboard>
