<x-dashboard>
<div>
    <div class="mb-3 text-center text-blue-800 font-bold text-xl">
        My applications
    </div>
    @foreach ($applications as $application)
        <div class='mb-4'>
            <div class="rounded-xl border p-5 shadow-md w-full bg-white w-full">
                <div class="flex w-full items-center justify-between border-b pb-3">
                    <div class="flex items-center space-x-3">
                        <div class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]">
                        </div>
                        <div class="text-lg font-bold text-slate-700">
                            {{ $application->user->name }}
                        </div>
                    </div>
                    <div class="flex items-center space-x-8">
                        <button class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">
                            # {{ $application->id }}
                        </button>
                        <div class="text-xs text-neutral-500">
                            {{ date('Y/m/d:m', strtotime($application->created_at) + 86400 - 86400) }}
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mt-4 mb-3">
                        <div class="mb-3 text-xl font-bold">
                            {{ $application->subject }}
                        </div>
                        <div class="text-sm text-neutral-600">
                            {{ $application->message }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-slate-500">
                            {{ $application->user->email }}
                        </div>
                        @if ($application->file_url)
                            <a download="{{ asset('storage/' . $application->file_url) }}"
                                href="{{ asset('storage/' . $application->file_url) }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                    <div class="mt-5">
                        @if ($application->answer)
                            <div>
                                <hr class="border">
                                <h3>Answer:</h3>
                                <p class="text-sm text-neutral-600">
                                    {{ $application->answer->body }}
                                </p>
                            </div>
                        @endif
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
