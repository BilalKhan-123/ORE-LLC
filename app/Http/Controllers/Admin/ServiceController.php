<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\ServicesService;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function __construct(
        protected ServicesService $serviceService
    ) {}

    public function index()
    {
        $services = $this->serviceService->list();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string',
            'description' => 'nullable|string',
            'is_show' => 'required|in:0,1',
        ]);

        $data = $request->except('_token', '_method');
        $data['all_text'] = $request->input('title') . ' ' . ($request->input('sub_title') ?? '');
        
        $baseSlug = Str::slug($request->input('title'));
        $slug = $baseSlug;
        $counter = 1;

        while (Service::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;

        // // Handle main image
        // if ($request->hasFile('image')) {
        //     try {
        //         $fileName = 'service_image_' . time();
        //         $imagePath = storeImage($request->file('image'), 'services', $fileName);
        //         $data['main_image'] = 'storage/' . $imagePath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['image' => $e->getMessage()])->withInput();
        //     }
        // }

        // // Handle logo
        // if ($request->hasFile('logo')) {
        //     try {
        //         $fileName = 'service_logo_' . time();
        //         $logoPath = storeImage($request->file('logo'), 'services', $fileName);
        //         $data['logo'] = 'storage/' . $logoPath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['logo' => $e->getMessage()])->withInput();
        //     }
        // }

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            storeImage($file, 'services', $filename); // Store the image using the helper function
            $data['main_image'] = 'services/' . $filename;
        }

        
        if ($request->hasFile('logo')) {

            $file = $request->file('logo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            storeImage($file, 'services', $filename); // Store the image using the helper function
            $data['logo'] = 'services/' . $filename;
        }

        


        $this->serviceService->store($data);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Record created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
       $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string',
            'description' => 'nullable|string',
            'is_show' => 'required|in:0,1',
        ]);

        $data = $request->except('_token', '_method');
        $data['all_text'] = $request->input('name') . ' ' . ($request->input('description') ?? '');

        $baseSlug = Str::slug($request->input('title'));
        $slug = $baseSlug;
        $counter = 1;

        while (Service::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;

        // Handle main image
        // if ($request->hasFile('image')) {
        //     try {
        //         $fileName = 'service_image_' . time();
        //         $imagePath = storeImage($request->file('image'), 'services', $fileName);
        //         $data['main_image'] = 'storage/' . $imagePath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['image' => $e->getMessage()])->withInput();
        //     }
        // }

        // // Handle logo
        // if ($request->hasFile('logo')) {
        //     try {
        //         $fileName = 'service_logo_' . time();
        //         $logoPath = storeImage($request->file('logo'), 'services', $fileName);
        //         $data['logo'] = 'storage/' . $logoPath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['logo' => $e->getMessage()])->withInput();
        //     }
        // }

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            storeImage($file, 'services', $filename); // Store the image using the helper function
            $data['main_image'] = 'services/' . $filename;
        }

        if ($request->hasFile('logo')) {

            $file = $request->file('logo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            storeImage($file, 'services', $filename); // Store the image using the helper function
            $data['logo'] = 'services/' . $filename;
        }

        if(isset($request->is_featured)) {
            $data['is_featured'] = $request->is_featured;
        }
        else {
            $data['is_featured'] = 0;
        }

        $this->serviceService->update($service, $data);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Record updated successfully.');
    }

    public function destroy(Service $service)
    {
        $this->serviceService->delete($service);

        return back()->with('success', 'Record deleted successfully.');
    }
}

