<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    {{-- Menampilkan semua error validasi --}}
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('category.store') }}" method="POST">
                    @csrf {{-- Token keamanan form Laravel --}}

                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 dark:text-gray-200">Category</label>

                        {{-- Input nama category --}}
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded border-gray-300 text-black">
                    </div>

                    {{-- Tombol simpan --}}
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Save Category
                    </button>

                    {{-- Tombol kembali --}}
                    <a href="{{ route('category.index') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded">
                        Cancel
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>