<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Skema Sertifikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6">
<header class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Edit Skema Sertifikasi</h3>
                        <p class="text-sm text-gray-600 mt-1">Perbarui data skema: {{ $scheme->code }} - {{ $scheme->name }}</p>
                    </header>
                    
                    <form action="{{ route('schemes.update', $scheme) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                                Kode Skema <span aria-label="wajib" class="text-red-500" role="presentation">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="code" 
                                id="code" 
                                value="{{ old('code', $scheme->code) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required
                                aria-required="true"
                                placeholder="Contoh: CS-001"
                                autocomplete="off"
                                maxlength="50"
                            >
                            @error('code')
                                <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Skema <span aria-label="wajib" class="text-red-500" role="presentation">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', $scheme->name) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required
                                aria-required="true"
                                placeholder="Contoh: Skema Sertifikasi IT"
                                autocomplete="off"
                            >
                            @error('name')
                                <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                            @endif
                        </div>
                        
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Deskripsi
                            </label>
                            <textarea 
                                name="description" 
                                id="description" 
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Deskripsi singkat tentang skema sertifikasi ini..."
                            >{{ old('description', $scheme->description) }}</textarea>
                        </div>
                        
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('schemes.show', $scheme) }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Perbarui Skema
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>