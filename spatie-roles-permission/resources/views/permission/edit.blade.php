<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Permission / Edit') }}
            </h2>
            <a href="{{ route('admin.permission') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Permission
                List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.permission.update', $permission->id) }}" method="post">
                        @csrf
                        <div>
                            <label for="name" class="test-lg font-medium">{{ __('Permission Name') }}</label>
                            <div class="my-3">
                                <input type="text" name="name" value="{{ $permission->name }}"
                                    placeholder="Enter Permission Name"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
