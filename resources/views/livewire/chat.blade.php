<div>
    <div class="pt-12">
        <div class="sticky top-0 z-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-t-lg sm:rounded-b-none">
                <div class="p-6 text-gray-900 dark:text-gray-100 gap-3 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 fill-current">
                            <path
                                d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8 .4 34.3z" />
                        </svg>
                    </a>
                    <h2 class="text-2xl font-semibold">Chat</h2>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-t-none">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div wire:poll>
                        @foreach ($messages as $message)
                            <div class="chat @if ($message->from_user_id == auth()->id()) chat-end @else chat-start @endif">
                                <div class="chat-image avatar">
                                    <div class="w-10 rounded-full">
                                        <img alt="{{ $message->fromUser->name }}"
                                            src="{{ env('ZOSMED_URL') }}/storage/{{ $message->fromUser->avatar_path }}" />
                                    </div>
                                </div>
                                <div class="chat-header">
                                    {{ $message->fromUser->name }}
                                    <time class="text-xs opacity-50">{{ $message->created_at->diffForHumans() }}</time>
                                </div>
                                <div class="chat-bubble">{{ $message->message }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="sticky bottom-0 bg-white dark:bg-gray-800 overflow-hidden">
                <div class="form-control p-4">
                    <label for="chat" class="sr-only">Your message</label>
                    <form action="" wire:submit.prevent="sendMessage"
                        class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                        <button type="button"
                            class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <button type="button"
                            class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <textarea id="chat" rows="1" wire:model.defer="message" required
                            class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Your message..."></textarea>
                        <button type="submit"
                            class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                            <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
