<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Role / Create') }}
            </h2>
            <a href="{{ route('admin.role') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Role
                List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.role.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="name" class="test-lg font-medium">{{ __('Role Name') }}</label>
                            <div class="my-3">
                                <input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Enter Role Name" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-4 mb-3">
                                @if (!empty($permissions))
                                    @foreach ($permissions as $permission)
                                        <div class="mt-3">
                                            <input type="checkbox" name="permissions[]" class="rounded"
                                                value="{{ $permission->name }}">
                                            <label for="permissions[]">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
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