<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use App\Services\AboutService;

class AboutController extends Controller
{
    public function __construct(
        protected AboutService $aboutService
    ) {}

    public function index()
    {
        $about = $this->aboutService->list();
        return view('admin.about.index', compact('about'));
    }
    
    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
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
        //         $imagePath = storeImage($request->file('image'), 'about', $fileName);
        //         $data['main_image'] = 'storage/' . $imagePath;
        //     } catch (\Exception $e) {
        //         return back()->withErrors(['image' => $e->getMessage()])->withInput();
        //     }
        // }

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            storeImage($file, 'about', $filename); // Store the image using the helper function
            $data['main_image'] = 'about/' . $filename;
        }

        // Combine all text for search/indexing
        $data['all_text'] = $request->input('title') . ' ' . 
                           ($request->input('description') ?? '');

        

        $this->aboutService->update($about, $data);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Record updated successfully.');
    }
}

