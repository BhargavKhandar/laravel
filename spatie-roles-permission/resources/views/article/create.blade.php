<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Article / Create') }}
            </h2>
            <a href="{{ route('article') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Article
                List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('article.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="title" class="test-lg font-medium">{{ __('Article Title') }}</label>
                            <div class="my-3">
                                <input type="text" name="title" value="{{ old('title') }}"
                                    placeholder="Enter Article Title"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('title')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <label for="Author" class="test-lg font-medium">{{ __('Article Author') }}</label>
                            <div class="my-3">
                                <input type="text" name="author" value="{{ old('author') }}"
                                    placeholder="Enter Article Author"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('author')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <label for="text" class="test-lg font-medium">{{ __('Article Content') }}</label>
                            <div class="my-3">
                                <textarea name="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg" cols="30" rows="7"
                                    placeholder="Enter Article Content"></textarea>
                                @error('text')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
