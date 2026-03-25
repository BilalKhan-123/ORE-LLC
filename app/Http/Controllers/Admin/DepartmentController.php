<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function __construct(
        protected DepartmentService $departmentService
    ) {}

    public function index()
    {
        $departments = $this->departmentService->list();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
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

        // if ($request->hasFile('image')) {
        //     try {
        //         $fileName = 'department_image_' . time();
        //         $imagePath = storeImage($request->file('image'), 'departments', $fileName);
        //         $data['main_image'] = 'storage/' . $imagePath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['image' => $e->getMessage()])->withInput();
        //     }
        // }

        // // Handle logo
        // if ($request->hasFile('logo')) {
        //     try {
        //         $fileName = 'department_logo_' . time();
        //         $logoPath = storeImage($request->file('logo'), 'departments', $fileName);
        //         $data['logo'] = 'storage/' . $logoPath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['logo' => $e->getMessage()])->withInput();
        //     }
        // }

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

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
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

        // if ($request->hasFile('image')) {
        //     try {
        //         $fileName = 'department_image_' . time();
        //         $imagePath = storeImage($request->file('image'), 'departments', $fileName);
        //         $data['main_image'] = 'storage/' . $imagePath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['image' => $e->getMessage()])->withInput();
        //     }
        // }

        // // Handle logo
        // if ($request->hasFile('logo')) {
        //     try {
        //         $fileName = 'department_logo_' . time();
        //         $logoPath = storeImage($request->file('logo'), 'departments', $fileName);
        //         $data['logo'] = 'storage/' . $logoPath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['logo' => $e->getMessage()])->withInput();
        //     }
        // }

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

            

        $this->departmentService->update($department, $data);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Record updated successfully.');
    }

    public function destroy(Department $department)
    {
        $this->departmentService->delete($department);

        return back()->with('success', 'Record deleted successfully.');
    }
}

