<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Peserta') }}
        </h2>
    </x-slot>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6">
                    <header class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Tambah Peserta</h3>
                        <p class="text-sm text-gray-600 mt-1">Buat peserta baru dan hubungkan ke skema sertifikasi.</p>
                    </header>
                    
                    <form action="{{ route('participants.store') }}" method="POST" novalidate>
                        @csrf
                        
                        <div class="mb-4" data-validate="name">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Lengkap <span aria-label="wajib" class="text-red-500" role="presentation">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required
                                aria-required="true"
                                placeholder="Contoh: Budi Santoso"
                                autocomplete="name"
                            >
                            <span class="error-message mt-1 text-sm text-red-600 hidden" id="error-name"></span>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600" role="alert" id="error-name-display">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4" data-validate="email">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email <span aria-label="wajib" class="text-red-500" role="presentation">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required
                                aria-required="true"
                                placeholder="contoh@email.com"
                                autocomplete="email"
                            >
                            <span class="error-message mt-1 text-sm text-red-600 hidden" id="error-email"></span>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600" role="alert" id="error-email-display">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Nomor Telepon
                            </label>
                            <input 
                                type="tel" 
                                name="phone" 
                                id="phone" 
                                value="{{ old('phone') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="08123456789"
                                pattern="[0-9\-\+\(\)]*"
                                autocomplete="tel"
                            >
                            <div class="mt-1 text-xs text-gray-500">
                                Format: 08xxxxxxxxx
                            </div>
                        </div>
                        
                        <div class="mb-6" data-validate="certification_scheme_code">
                            <label for="certification_scheme_code" class="block text-sm font-medium text-gray-700 mb-1">
                                Skema Sertifikasi <span aria-label="wajib" class="text-red-500" role="presentation">*</span>
                            </label>
                            <div class="relative">
                                <select 
                                    name="certification_scheme_code" 
                                    id="certification_scheme_code" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm appearance-none pr-8"
                                    required
                                    aria-required="true"
                                >
                                    <option value="">-- Pilih Skema Sertifikasi --</option>
                                    @foreach($schemes as $scheme)
                                        <option value="{{ $scheme->code }}" {{ old('certification_scheme_code') == $scheme->code ? 'selected' : '' }}>
                                            {{ $scheme->code }} - {{ $scheme->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L9.293 12.95z"/></svg>
                                </div>
                            </div>
                            <span class="error-message mt-1 text-sm text-red-600 hidden" id="error-certification_scheme_code"></span>
                            @error('certification_scheme_code')
                                <p class="mt-1 text-sm text-red-600" role="alert" id="error-certification_scheme_code-display">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end space-x-4">
                            <button type="reset" 
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Reset Form
                            </button>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                
                                Simpan Peserta
                            </button>
                            <a href="{{ route('participants.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>