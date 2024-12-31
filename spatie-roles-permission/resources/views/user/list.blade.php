<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User') }}
            </h2>
            @can('Create user')
                <a href="{{ route('admin.user.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Create
                    User</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-_message></x-_message>

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <td class="px-6 py-3 text-left">#</td>
                        <td class="px-6 py-3 text-left">Name</td>
                        <td class="px-6 py-3 text-left">Email</td>
                        <td class="px-6 py-3 text-left">Role</td>
                        <td class="px-6 py-3 text-center">
                            @can('Edit user' || 'Delete user')
                                Actions
                            @endcan
                        </td>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if (!empty($users))
                        @foreach ($users as $key => $user)
                            <tr>
                                <td class="px-6 py-3 text-left">
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $user->roles->pluck('name')->implode('') }}
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex justify-center">
                                        @can('Edit user')
                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                                class="bg-slate-700 text-sm rounded-md text-white px-3 mr-2 py-2 hover:bg-slate-600">
                                                Edit
                                            </a>
                                        @endcan
                                        {{-- <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">
                                                Delete
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="my-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
