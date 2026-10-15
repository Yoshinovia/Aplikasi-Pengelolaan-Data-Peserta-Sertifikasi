<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Peserta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6">
<header class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            Daftar Peserta
                        </h3>
                    </header>
                    
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form method="GET" class="mb-4 flex space-x-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peserta..."
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <select name="certification_scheme_code" onchange="this.form.submit()">
                                <option value="">Semua Skema</option>
                                @foreach($schemes as $scheme)
                                    <option value="{{ $scheme->code }}" {{ request('certification_scheme_code') == $scheme->code ? 'selected' : '' }}>
                                        {{ $scheme->code }} - {{ $scheme->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
                            Filter
                        </button>
                    </form>
                    
                    @if($participants->isEmpty())
                        <p class="text-gray-500 text-center py-8">
                            Tidak ada data peserta. <a href="{{ route('participants.create') }}" class="underline">Tambah peserta</a>.
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Telepon
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Skema Sertifikasi
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Aksi</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($participants as $participant)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $participant->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $participant->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $participant->phone ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $participant->certificationScheme->code ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('participants.show', $participant) }}"
                                                   class="text-indigo-600 hover:text-indigo-900 underline">
                                                    Lihat
                                                </a>
                                                <a href="{{ route('participants.edit', $participant) }}"
                                                   class="ml-3 text-indigo-600 hover:text-indigo-900 underline">
                                                    Edit
                                                </a>
                                                <form action="{{ route('participants.destroy', $participant) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Apakah Anda yakin akan menghapus peserta ini?');"
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
                                Menampilkan {{ $participants->firstItem() }}-{{ $participants->lastItem() }} dari {{ $participants->total() }} data
                            </p>
                            {{ $participants->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>