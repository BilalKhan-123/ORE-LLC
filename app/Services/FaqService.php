<?php
namespace App\Services;

use App\Models\Faq;

class FaqService
{
    public function list($perPage = 10)
    {
        return Faq::latest()->paginate($perPage);
    }

    public function store(array $data)
    {
        return Faq::create($data);
    }

    public function update(Faq $faq, array $data)
    {
        $faq->update($data);
        return $faq;
    }

    public function delete(Faq $faq)
    {
        return $faq->delete();
    }
}
