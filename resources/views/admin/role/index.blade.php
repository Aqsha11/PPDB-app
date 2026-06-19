<x-app-layout>
    <x-slot name="header">Manajemen Role</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Roles']
        ]" />

        <div class="flex justify-end">
            <x-primary-button onclick="window.location='{{ route('admin.role.create') }}'">
                + Tambah Role
            </x-primary-button>
        </div>

        <x-card>
            @if($data->count() > 0)
                <x-table :headers="['Nama Role', 'Permissions Count', 'Aksi']">
                    @foreach($data as $row)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium capitalize text-gray-900">{{ $row->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <x-badge color="blue">{{ $row->permissions->count() }} permission</x-badge>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.role.show', $row->id) }}" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Detail</a>
                                    <a href="{{ route('admin.role.edit', $row->id) }}" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Edit</a>
                                    <form action="{{ route('admin.role.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus role ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            @else
                <x-empty-state title="Belum ada role" description="Belum ada role yang tersedia. Tambah role baru untuk memberikan hak akses." />
            @endif
        </x-card>
    </div>
</x-app-layout>
