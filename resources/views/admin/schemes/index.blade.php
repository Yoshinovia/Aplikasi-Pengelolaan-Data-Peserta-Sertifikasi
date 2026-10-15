<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skema Sertifikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6">
<header class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            Daftar Skema Sertifikasi
                        </h3>
                    </header>
                    
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($schemes->isEmpty())
                        <p class="text-gray-500 text-center py-8">
                            Belum ada skema sertifikasi. <a href="{{ route('schemes.create') }}" class="underline">Tambah pertama</a>.
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kode
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Deskripsi
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Aksi</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($schemes as $scheme)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $scheme->code }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $scheme->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $scheme->description ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('schemes.show', $scheme) }}"
                                                   class="text-indigo-600 hover:text-indigo-900 underline">
                                                    Lihat
                                                </a>
                                                <a href="{{ route('schemes.edit', $scheme) }}"
                                                   class="ml-3 text-indigo-600 hover:text-indigo-900 underline">
                                                    Edit
                                                </a>
                                                <form action="{{ route('schemes.destroy', $scheme) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Apakah Anda yakin akan menghapus skema ini?');"
                                                      class="ml-3 inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 underline">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4 flex items-center justify-between">
                            <p class="text-sm text-gray-500">
                                Menampilkan {{ $schemes->firstItem() }}-{{ $schemes->lastItem() }} dari {{ $schemes->total() }} data
                            </p>
                            {{ $schemes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>