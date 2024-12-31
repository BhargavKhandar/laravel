<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User / Create') }}
            </h2>
            <a href="{{ route('admin.user') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">User
                List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.user.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="name" class="test-lg font-medium">{{ __('User Name') }}</label>
                            <div class="my-3">
                                <input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Enter User Name" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <label for="email" class="test-lg font-medium">{{ __('User Email') }}</label>
                            <div class="my-3">
                                <input type="email" name="email" value="{{ old('email') }}"
                                    placeholder="Enter User Email" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('email')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <label for="password" class="test-lg font-medium">{{ __('User Password') }}</label>
                            <div class="my-3">
                                <input type="password" name="password" value="{{ old('password') }}"
                                    placeholder="Enter User Password"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('password')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <label for="password_confirmation"
                                class="test-lg font-medium">{{ __('User Confirm Password') }}</label>
                            <div class="my-3">
                                <input type="password" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}"
                                    placeholder="Enter User Confirm Password"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('password_confirmation')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- <div class="grid grid-cols-4 mb-3">
                                @if (!empty($roles))
                                    @foreach ($roles as $role)
                                        <div class="mt-3">
                                            <input type="checkbox" name="roles[]" class="rounded"
                                                value="{{ $role->name }}">
                                            <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div> --}}
                            <div class="mb-3">
                                <label for="role"
                                    class="block font-medium text-gray-700 mb-2">{{ __('Select Role') }}</label>
                                @if (!empty($roles))
                                    <select name="role" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @error('role')
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
