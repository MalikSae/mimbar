<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('donationPrograms')->where('type', 'donation')->orderBy('name');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->paginate(15)->withQueryString();

        return view('admin.program_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,NULL,id,type,donation',
        ]);

        Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'type'        => 'donation',
            'description' => null,
        ]);

        return back()->with('success', 'Kategori Program Donasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('type', 'donation')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $id . ',id,type,donation',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            // type is fixed to donation
        ]);

        return back()->with('success', 'Kategori Program Donasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = Category::where('type', 'donation')->findOrFail($id);
        $category->delete();
        
        return back()->with('success', 'Kategori Program Donasi berhasil dihapus.');
    }
}
