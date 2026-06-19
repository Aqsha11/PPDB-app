<x-app-layout>
    <x-slot name="header">Manajemen User</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users']
        ]" />

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form action="{{ route('admin.user.index') }}" method="GET" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Cari user..." value="{{ request('search') }}"
                    class="w-full sm:w-64 rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <x-primary-button type="submit">Cari</x-primary-button>
            </form>
            <x-primary-button onclick="window.location='{{ route('admin.user.create') }}'">
                + Tambah User
            </x-primary-button>
        </div>

        <x-card>
            @if($data->count() > 0)
                <x-table :headers="['Nama', 'Email', 'Role(s)', 'Terdaftar', 'Aksi']">
                    @foreach($data as $row)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $row->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $row->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($row->roles as $role)
                                        <x-badge color="blue">{{ $role->name }}</x-badge>
                                    @empty
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $row->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.user.show', $row->id) }}" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Detail</a>
                                    <a href="{{ route('admin.user.edit', $row->id) }}" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Edit</a>
                                    <form action="{{ route('admin.user.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            @else
                <x-empty-state title="Belum ada user" description="Belum ada user yang terdaftar di sistem." />
            @endif
        </x-card>

        @if(method_exists($data, 'links'))
            <div class="mt-6">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
