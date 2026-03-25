<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Services\TestimonialService;

class TestimonialController extends Controller
{
    public function __construct(
        protected TestimonialService $testimonialService
    ) {}

    public function index()
    {
        $testimonials = $this->testimonialService->list();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'is_show' => 'required|in:0,1',
        ]);

        $data = $request->except('_token', '_method');
        $data['all_text'] = $request->input('name') . ' ' . ($request->input('description') ?? '') . ' ' . ($request->input('designation') ?? '') . ' ' . ($request->input('company') ?? '');

        $this->testimonialService->store($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'is_show' => 'required|in:0,1',
        ]);

        $data = $request->except('_token', '_method');
        $data['all_text'] = $request->input('name') . ' ' . ($request->input('description') ?? '') . ' ' . ($request->input('designation') ?? '') . ' ' . ($request->input('company') ?? '');

        $this->testimonialService->update($testimonial, $data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->testimonialService->delete($testimonial);

        return back()->with('success', 'Testimonial deleted successfully.');
    }
}
