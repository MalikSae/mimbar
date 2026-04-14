<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QurbanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QurbanItemController extends Controller
{
    protected array $types = ['domba', 'kambing', 'sapi', 'sapi_kolektif'];

    public function index()
    {
        $items = QurbanItem::orderBy('type')->orderBy('price')->paginate(20);
        return view('admin.qurban.items.index', compact('items'));
    }

    public function create()
    {
        $types = $this->types;
        return view('admin.qurban.items.form', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'type'         => 'required|in:domba,kambing,sapi,sapi_kolektif',
            'price'        => 'required|integer|min:1',
            'weight_info'  => 'nullable|string|max:100',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|max:4096',
            'is_available' => 'nullable|boolean',
        ]);

        $data = [
            'name'         => $request->name,
            'type'         => $request->type,
            'price'        => $request->price,
            'weight_info'  => $request->weight_info,
            'description'  => $request->description,
            'is_available' => $request->boolean('is_available', true),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('qurban', 'public');
        }

        QurbanItem::create($data);

        return redirect()->route('admin.qurban.items.index')
            ->with('success', 'Hewan qurban berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item  = QurbanItem::findOrFail($id);
        $types = $this->types;
        return view('admin.qurban.items.form', compact('item', 'types'));
    }

    public function update(Request $request, $id)
    {
        $item = QurbanItem::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'type'         => 'required|in:domba,kambing,sapi,sapi_kolektif',
            'price'        => 'required|integer|min:1',
            'weight_info'  => 'nullable|string|max:100',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|max:4096',
            'is_available' => 'nullable|boolean',
        ]);

        $data = [
            'name'         => $request->name,
            'type'         => $request->type,
            'price'        => $request->price,
            'weight_info'  => $request->weight_info,
            'description'  => $request->description,
            'is_available' => $request->boolean('is_available', true),
        ];

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('qurban', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.qurban.items.index')
            ->with('success', 'Hewan qurban berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = QurbanItem::findOrFail($id);
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return back()->with('success', 'Hewan qurban berhasil dihapus.');
    }

    public function toggle($id)
    {
        $item = QurbanItem::findOrFail($id);
        $item->is_available = !$item->is_available;
        $item->save();
        return response()->json(['is_available' => $item->is_available]);
    }
}
