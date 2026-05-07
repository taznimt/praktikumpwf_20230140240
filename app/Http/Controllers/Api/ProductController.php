<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        try {
            // ambil semua product beserta category
            $products = Product::with(['category', 'user'])->latest()->get();

            return response()->json([
                'message' => 'List product berhasil diambil',
                'data' => $products,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil list product', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data',
            ], 500);
        }
    }

    public function store(StoreProductRequest $request)
    {
        try {
            // validasi request
            $validated = $request->validated();

            // tambahkan user login
            $validated['user_id'] = Auth::id();

            // simpan product
            $product = Product::create($validated);

            Log::info('Menambah data produk', [
                'list' => $product,
            ]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menambah product',
            ], 500);
        }
    }

    public function show(int $id)
    {
        try {
            // ambil product berdasarkan id
            $product = Product::with(['category', 'user'])->find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data product', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil product',
            ], 500);
        }
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        try {
            // cari product
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            // update product
            $product->update($request->validated());

            return response()->json([
                'message' => 'Product berhasil diupdate',
                'data' => $product,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal update product', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat update product',
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            // cari product
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            // hapus product
            $product->delete();

            return response()->json([
                'message' => 'Product berhasil dihapus',
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal hapus product', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus product',
            ], 500);
        }
    }
}