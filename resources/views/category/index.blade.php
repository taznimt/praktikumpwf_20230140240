<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    {{-- Menampilkan pesan sukses --}}
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Category List</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Manage your category</p>
                    </div>

                    {{-- Tombol tambah category --}}
                    <a href="{{ route('category.create') }}"
                       class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">
                        Add Category
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 text-black">
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Total Product</th>
                                <th class="border px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $index => $category)
                                <tr>
                                    {{-- Nomor urut --}}
                                    <td class="border px-4 py-2">{{ $index + 1 }}</td>

                                    {{-- Nama category --}}
                                    <td class="border px-4 py-2">{{ $category->name }}</td>

                                    {{-- Total product yang punya category ini --}}
                                    <td class="border px-4 py-2">{{ $category->products_count }}</td>

                                    {{-- Tombol aksi --}}
                                    <td class="border px-4 py-2 space-x-2">
                                        <a href="{{ route('category.edit', $category->id) }}" class="text-yellow-600">
                                            Edit
                                        </a>

                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Yakin hapus category?')" class="text-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    {{-- Jika data category belum ada --}}
                                    <td colspan="4" class="border px-4 py-2 text-center">
                                        Belum ada category
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>