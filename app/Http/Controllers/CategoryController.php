<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = Str::slug($request->name);
        $iconPath = null;
        if ($request->has('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
        }
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $iconPath,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|string|max:255' . $id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $id,
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if ($request->hasFile('icon')) {
            if ($category->icon) {
                Storage::delete('public/icons/' . $category->icon);
            }

            $category->icon = $request->file('icon')->store('icons', 'public');
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::withCount('courses')->findOrFail($id);

        if ($category->courses_count > 0) {
            return redirect()->route('categories.index')->with('error', 'Category tidak bisa dihapus karena terkait dengan courses.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category berhasil dihapus.');
    }
    public function search(Request $request)
    {
        $query = $request->query('q');
        $categories = Category::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($categories);
    }
}