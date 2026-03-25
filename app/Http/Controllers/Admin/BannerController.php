<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Services\BannerService;

class BannerController extends Controller
{
    public function __construct(
        protected BannerService $bannerService
    ) {}

    public function index()
    {
        $banners = $this->bannerService->list();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,svg',
            'is_show' => 'required|in:0,1',
        ]);

        // $data = $request->except('_token', '_method');
        // $data['all_text'] = $request->input('title') . ' ' . ($request->input('description') ?? '');

        // // Handle image upload
        // if ($request->hasFile('image')) {
        //     try {
        //         $imagePath = storeImage($request->file('image'), 'banners', 'banner_' . time());
        //         $data['image'] = $imagePath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['image' => $e->getMessage()])->withInput();
        //     }
        // }
        $data = $request->except('_token', '_method');

        // Handle image upload
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            storeImage($file, 'banners', $filename); // Store the image using the helper function
            $data['main_image'] = 'banners/' . $filename;
        }

        // Combine all text for search/indexing
        $data['all_text'] = $request->input('title') . ' ' . 
                           ($request->input('description') ?? '');

        $this->bannerService->store($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Record created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,svg',
            'is_show' => 'required|in:0,1',
        ]);

        $data = $request->except('_token', '_method');

        // Handle image upload
        // if ($request->hasFile('image')) {
        //     try {
        //         $fileName = 'about_' . time();
        //         $imagePath = storeImage($request->file('image'), 'hero-carousel', $fileName);
        //         $data['main_image'] = 'storage/' . $imagePath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['image' => $e->getMessage()])->withInput();
        //     }
        // }

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            storeImage($file, 'banners', $filename); // Store the image using the helper function
            $data['main_image'] = 'banners/' . $filename;
        }

        // Combine all text for search/indexing
        $data['all_text'] = $request->input('title') . ' ' . 
                           ($request->input('description') ?? '');

        $this->bannerService->update($banner, $data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Record updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $this->bannerService->delete($banner);

        return back()->with('success', 'Record deleted successfully.');
    }
}

