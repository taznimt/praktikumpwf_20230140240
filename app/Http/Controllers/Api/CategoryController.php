<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            // ambil semua category + total product
            $categories = Category::withCount('products')->latest()->get();

            return response()->json([
                'message' => 'List category berhasil diambil',
                'data' => $categories,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil list category', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil category',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
            ]);

            // simpan category
            $category = Category::create($validated);

            return response()->json([
                'message' => 'Category berhasil ditambahkan',
                'data' => $category,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menambah category', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menambah category',
            ], 500);
        }
    }

    public function show(int $id)
    {
        try {
            // cari category
            $category = Category::withCount('products')->find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Category berhasil diambil',
                'data' => $category,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil category', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil category',
            ], 500);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            // cari category
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category tidak ditemukan',
                ], 404);
            }

            // validasi update
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
            ]);

            // update
            $category->update($validated);

            return response()->json([
                'message' => 'Category berhasil diupdate',
                'data' => $category,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal update category', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat update category',
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            // cari category
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category tidak ditemukan',
                ], 404);
            }

            // hapus
            $category->delete();

            return response()->json([
                'message' => 'Category berhasil dihapus',
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal hapus category', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat hapus category',
            ], 500);
        }
    }
}