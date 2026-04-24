<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Product Detail</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Viewing product #{{ $product->id }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        @can('update', $product)
                            <x-edit-product :url="route('product.edit', $product->id)" name="Product" />
                        @endcan

                        @can('delete', $product)
                            <x-delete-product :url="route('product.destroy', $product->id)" name="Product" />
                        @endcan
                    </div>
                </div>

                <div class="border border-gray-300 dark:border-gray-700 rounded-lg divide-y divide-gray-300 dark:divide-gray-700">
                    <div class="flex px-6 py-4">
                        <div class="w-40 text-gray-500 dark:text-gray-400">Product Name</div>
                        <div class="text-gray-800 dark:text-gray-100 font-semibold">{{ $product->name }}</div>
                    </div>

                    <div class="flex px-6 py-4">
                        <div class="w-40 text-gray-500 dark:text-gray-400">Quantity</div>
                        <div class="text-gray-800 dark:text-gray-100">{{ $product->qty }}</div>
                    </div>

                    <div class="flex px-6 py-4">
                        <div class="w-40 text-gray-500 dark:text-gray-400">Price</div>
                        <div class="text-gray-800 dark:text-gray-100">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>

                    <div class="flex px-6 py-4">
                        <div class="w-40 text-gray-500 dark:text-gray-400">Owner</div>
                        <div class="text-gray-800 dark:text-gray-100">{{ $product->user->name ?? '-' }}</div>
                    </div>

                    <div class="flex px-6 py-4">
                        <div class="w-40 text-gray-500 dark:text-gray-400">Created At</div>
                        <div class="text-gray-800 dark:text-gray-100">{{ $product->created_at }}</div>
                    </div>

                    <div class="flex px-6 py-4">
                        <div class="w-40 text-gray-500 dark:text-gray-400">Updated At</div>
                        <div class="text-gray-800 dark:text-gray-100">{{ $product->updated_at }}</div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('product.index') }}"
                       class="inline-block px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>