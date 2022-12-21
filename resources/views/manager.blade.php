<x-dashboard>
    <div>
        <div class="mb-3 text-center text-blue-800 font-bold text-xl">
            Recieved Applications
        </div>
        @foreach ($applications as $item)
            <div class='mb-4'>
                <div class="rounded-xl border p-5 shadow-md w-full bg-white w-full">
                    <div class="flex w-full items-center justify-between border-b pb-3">
                        <div class="flex items-center space-x-3">
                            <div class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]"></div>
                            <div class="text-lg font-bold text-slate-700">
                                {{ $item->user->name }}
                            </div>
                        </div>
                        <div class="flex items-center space-x-8">
                            <button class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">
                                # {{ $item->id }}
                            </button>
                            <div class="text-xs text-neutral-500">
                                {{ date('Y/m/d:m', strtotime($item->created_at) + 86400 - 86400) }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-3">
                        <div class="mb-3 text-xl font-bold">
                            {{ $item->subject }}
                        </div>
                        <div class="text-sm text-neutral-600">
                            {{ $item->message }}
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-slate-500">
                            {{ $item->user->email }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="flex flex-col-reverse">
            {{ $applications->links() }}
        </div>
    </div>
</x-dashboard>
