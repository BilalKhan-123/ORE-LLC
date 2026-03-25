<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserContactMessage;
use Illuminate\Http\Request;
use App\Services\UserContactMessageServices;
use Illuminate\Support\Str;

class UserContactMessageController extends Controller
{
    public function __construct(
        protected UserContactMessageServices $userContactMessageServices
    ) {}

    public function index()
    {
        $userContactMessages = $this->userContactMessageServices->list();
        return view('admin.userContactMessages.index', compact('userContactMessages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,svg',
            'is_show' => 'required|in:0,1',
        ]);

        $data = $request->except('_token', '_method');
        $data['all_text'] = $request->input('name') . ' ' . ($request->input('description') ?? '');

        $baseSlug = Str::slug($request->input('title'));
        $slug = $baseSlug;
        $counter = 1;

        while (Department::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            storeImage($file, 'departments', $filename); // Store the image using the helper function
            $data['main_image'] = 'departments/' . $filename;
        }

        if ($request->hasFile('logo')) {

            $file = $request->file('logo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            storeImage($file, 'departments', $filename); // Store the image using the helper function
            $data['logo'] = 'departments/' . $filename;
        }

        $this->departmentService->store($data);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Record created successfully.');
    }

    public function show(UserContactMessage $userContactMessage,$id)
    {
        $userContactMessage = $this->userContactMessageServices->show($id);
        return view('admin.userContactMessages.view', compact('userContactMessage'));
    }
   

    public function destroy(Department $department)
    {
        $this->userContactMessageServices->delete($department);

        return back()->with('success', 'Record deleted successfully.');
    }
}

