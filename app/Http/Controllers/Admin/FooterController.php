<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FooterColumn;
use App\Models\FooterLink;

class FooterController extends Controller
{
    public function index()
    {
        $columns = FooterColumn::with('links')->orderBy('order')->get();
        return view('admin.footer.index', compact('columns'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'order' => 'integer']);
        FooterColumn::create($request->all());
        return redirect()->back()->with('success', 'Footer column created.');
    }

    public function update(Request $request, FooterColumn $footer)
    {
        $request->validate(['title' => 'required', 'order' => 'integer']);
        $footer->update($request->all());
        return redirect()->back()->with('success', 'Footer column updated.');
    }

    public function destroy(FooterColumn $footer)
    {
        $footer->delete();
        return redirect()->back()->with('success', 'Footer column deleted.');
    }

    // Link Methods
    public function storeLink(Request $request, FooterColumn $column)
    {
        $request->validate([
            'label' => 'required',
            'url' => 'required',
            'order' => 'integer'
        ]);
        
        $column->links()->create($request->all());
        return redirect()->back()->with('success', 'Link added successfully.');
    }

    public function destroyLink(FooterLink $link)
    {
        $link->delete();
        return redirect()->back()->with('success', 'Link deleted successfully.');
    }
}
