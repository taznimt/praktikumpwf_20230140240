<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Ambil semua category + hitung total product
        $categories = Category::withCount('products')->latest()->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        // Tampilkan form tambah category
        return view('category.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'Nama category wajib diisi.',
            'name.unique' => 'Nama category sudah ada.',
        ]);

        // Simpan category
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        // Ambil data category
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        // Ambil category yang akan diupdate
        $category = Category::findOrFail($id);

        // Validasi update
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'Nama category wajib diisi.',
            'name.unique' => 'Nama category sudah ada.',
        ]);

        // Update category
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category berhasil diupdate');
    }

    public function destroy(string $id)
    {
        // Ambil category
        $category = Category::findOrFail($id);

        // Hapus category
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category berhasil dihapus');
    }
}