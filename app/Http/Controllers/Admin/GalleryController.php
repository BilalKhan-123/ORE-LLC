<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galary;
use Illuminate\Http\Request;
use App\Services\GalleryService;

class GalleryController extends Controller
{
    public function __construct(
        protected GalleryService $galleryService
    ) {}

    public function index()
    {
        $galleries = $this->galleryService->list();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif,bmp,svg',
        ]);

        $data = $request->except('_token', '_method');

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                try {
                    // $fileName = 'gallery_' . time() . '_' . uniqid();
                    // $path = $file->storeAs(
                    //     'gallery',
                    //     $fileName . '.' . $file->getClientOriginalExtension(),
                    //     'public'
                    // );

                    // $this->galleryService->store([
                    //     'main_image' => 'storage/' . $path,
                    //     'title'      => $fileName . time(), 
                    //     'all_text'   => $request->input('title') . ' ' . ($request->input('description') ?? ''),
                    // ]);

                    $folderName = 'gallery';
                    $imageName  = 'gallery_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Destination path inside public_html/storage/gallery
                    $destinationPath = base_path('../public_html/storage/'.$folderName);

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true); // recursive create
                    }

                    $file->move($destinationPath, $imageName);

                    $this->galleryService->store([
                        'main_image' => $folderName.'/'.$imageName,
                        'title'      => 'gallery_' . time() . uniqid(), 
                        'all_text'   => $request->input('title') . ' ' . ($request->input('description') ?? ''),
                    ]);


                } catch (\Exception $e) {
                    return back()->withErrors(['images' => $e->getMessage()])->withInput();
                }
            }
        }


        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Record(s) created successfully.');
    }

    public function edit(Galary $gallery)
    {
        // return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Galary $gallery)
    {
       return 'update';
    }

    public function destroy(Galary $gallery)
    {
        $this->galleryService->delete($gallery);

        return back()->with('success', 'Record deleted successfully.');
    }
}

