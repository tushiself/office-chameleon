<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $policy = Policy::latest()->get()->first();
        return view('admin.policy.index', compact('policy'));
    }

    public function create()
    {
        return view('admin.policy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable',
        ]);

        Policy::create($request->only('content'));

        return redirect()->route('policy.index')->with('success', 'Post created!');
    }

    public function edit(Policy $post, $id)
    {
        $policy = Policy::find($id);
        return view('admin.policy.edit', compact('policy'));
    }

    public function update(Request $request, Policy $policy)
    {
        $request->validate([
            'content' => 'nullable',
        ]);

        $policy->update([
            'content' => $request->content,
        ]);

        return redirect()->route('policy.index')->with('success', 'Policy updated!');
    }


    public function show($id)
    {
        $policy = Policy::find($id);
        return view('admin.policy.show', compact('policy'));
    }

    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        $policy->delete();

        return redirect()->route('policy.index')->with('success', 'Policy deleted successfully.');
    }
}
