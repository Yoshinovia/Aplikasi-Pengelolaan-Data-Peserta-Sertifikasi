<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Skema Sertifikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Kode</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $scheme->code }}</dd>
                        
                        <dt class="text-sm font-medium text-gray-500">Nama</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $scheme->name }}</dd>
                        
                        <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $scheme->description ?? '-' }}</dd>
                        
                        <dt class="text-sm font-medium text-gray-500">Dibuat</dt>
                        <dd class="mt-1 text-sm text-gray-500">{{ $scheme->created_at->diffForHumans() }}</dd>
                        
                        <dt class="text-sm font-medium text-gray-500">Diperbarui</dt>
                        <dd class="mt-1 text-sm text-gray-500">{{ $scheme->updated_at->diffForHumans() }}</dd>
                    </dl>
                    
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('schemes.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>