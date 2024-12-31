<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Role') }}
            </h2>
            @can('Create role')
                <a href="{{ route('admin.role.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Create
                    Role</a>
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
                        <td class="px-6 py-3 text-left">Permission</td>
                        <td class="px-6 py-3 text-center">
                            @can('Edit role' || 'Delete role')
                                Actions
                            @endcan
                        </td>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if (!empty($roles))
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td class="px-6 py-3 text-left">
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $role->name }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $role->permissions->pluck('name')->implode(', ') }}
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex justify-center">
                                        @can('Edit role')
                                            <a href="{{ route('admin.role.edit', $role->id) }}"
                                                class="bg-slate-700 text-sm rounded-md text-white px-3 mr-2 py-2 hover:bg-slate-600">
                                                Edit
                                            </a>
                                        @endcan
                                        @can('Delete role')
                                            <form action="{{ route('admin.role.destroy', $role->id) }}" method="post">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
