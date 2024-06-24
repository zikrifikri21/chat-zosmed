<x-app-layout>
    <div class="py-12">
        <div class="sticky top-0 z-10 max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-t-lg sm:rounded-b-none">
                <div class="p-6 text-gray-900 dark:text-gray-100 gap-3 flex items-center">
                    <h2 class="text-2xl font-semibold">
                        Friends
                    </h2>
                </div>
            </div>
        </div>
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-t-none">
                <div class="p-3 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-wrap gap-4 justify-start max-w-full mx-auto">
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <nav class="flex  flex-col gap-1 font-sans text-base font-normal text-gray-700">
                                @foreach ($users as $user)
                                    <a role="button" wire:navigate href="{{ route('chat', $user->name) }}"
                                        class="flex items-center w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-gray-100 hover:bg-opacity-80 hover:text-gray-900 focus:bg-gray-100 focus:bg-opacity-80 focus:text-gray-900 active:bg-gray-100 active:bg-opacity-80 active:text-gray-900 dark:hover:bg-gray-900 dark:hover:bg-opacity-80 dark:focus:bg-gray-900 dark:focus:bg-opacity-80 dark:active:bg-gray-900 dark:active:bg-opacity-80 dark:hover:text-gray-100 dark:focus:text-gray-100 dark:active:text-gray-100">
                                        <div class="grid mr-4 place-items-center">
                                            <img alt="candice"
                                                src="{{ env('ZOSMED_URL') }}/storage/{{ $user->avatar_path }}"
                                                class="relative inline-block h-12 w-12 rounded-full object-cover object-center" />
                                        </div>
                                        <div>
                                            <h6
                                                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-gray-900 dark:text-gray-100 -mb-1">
                                                {{ $user->name }}
                                            </h6>
                                            @if (isset($latestMessages[$user->id]))
                                                <p
                                                    class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700 dark:text-gray-400">
                                                    {{ Str::limit($latestMessages[$user->id]->message, 20) }}
                                                </p>
                                                <small class="text-xs">
                                                    {{ $latestMessages[$user->id]->created_at->diffForHumans() }}
                                                </small>
                                            @else
                                                <p>No messages yet.</p>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <h2 class="text-xl font-bold mb-3 block sm:hidden">Groups</h2>
                            @foreach ($groups as $group)
                                <div class="mb-3 cursor-pointer rounded-xl hover:bg-gray-100 dark:hover:bg-gray-900">
                                    <a href="#" class="flex item-start gap-3 py-2 px-3">
                                        <div class="w-[32px] h-[32px] relative">
                                            <img src="{{ env('ZOSMED_URL') }}/storage/{{ $group->cover_path }}"
                                                class="absolute inset-0 h-full w-full object-cover rounded-full" />
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between">
                                                <h3
                                                    class="font-black text-lg leading-none text-gray-900 dark:text-gray-100">
                                                    {{ $group->name }}
                                                </h3>
                                                <p class="text-xs text-gray-300 dark:text-gray-500">
                                                    {{ $group->status === 'approved' ? ($group->role === 'admin' ? $group->role : '') : 'not approved' }}
                                                </p>
                                            </div>
                                            <div class="text-xs text-gray-500" v-html="group.description"></div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="sticky bottom-0 bg-white dark:bg-gray-800 sm:rounded-b-lg">
                <div class="form-control p-4">
                    <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
