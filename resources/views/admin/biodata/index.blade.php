<x-app-layout>
    <x-slot name="header">Biodata Siswa</x-slot>

    <div class="mb-6 space-y-4">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('admin.dashboard')],
            ['label' => 'Biodata Siswa'],
        ]" />

        <form method="GET" action="{{ route('admin.biodata.index') }}" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" placeholder="Cari NISN, nama, atau email..." value="{{ request('search') }}" class="w-full sm:w-64 rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5 text-sm">
            <button type="submit" class="px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.biodata.index') }}" class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">Reset</a>
            @endif
        </form>
    </div>

    <x-card>
        <x-table :headers="['NISN', 'Nama', 'Email', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Aksi']">
            @forelse($data as $s)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $s->nisn ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $s->user->name ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $s->user->email ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $s->tempat_lahir ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $s->tanggal_lahir ? $s->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $s->jenis_kelamin ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.biodata.show', $s->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        <a href="{{ route('admin.biodata.edit', $s->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('admin.biodata.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus biodata ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center">
                        <x-empty-state title="Belum ada data siswa" description="Data siswa akan muncul setelah pengguna melengkapi biodata." />
                    </td>
                </tr>
            @endforelse
        </x-table>
        @if(method_exists($data, 'links'))
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $data->links() }}
            </div>
        @endif
    </x-card>
</x-app-layout>
