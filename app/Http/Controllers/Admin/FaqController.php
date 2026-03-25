<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Services\FaqService;

class FaqController extends Controller
{
    public function __construct(
        protected FaqService $faqService
    ) {}

    public function index()
    {
        $faqs = $this->faqService->list();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'short_answer' => 'required|string',
            //'long_answer' => 'required|string',
            'is_show' => 'required|in:0,1',
        ]);

        $data = $request->except('_token', '_method');

        $this->faqService->store($data);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Record created successfully.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'short_answer' => 'required|string',
            //'long_answer' => 'required|string',
            'is_show' => 'required|in:0,1',
        ]);

        $data = $request->except('_token', '_method');
        
        $this->faqService->update($faq, $data);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Record updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $this->faqService->delete($faq);

        return back()->with('success', 'Record deleted successfully.');
    }
}

