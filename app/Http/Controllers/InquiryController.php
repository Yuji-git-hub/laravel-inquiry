<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index() {
        return view('inquiries.index');
    }

    public function store(StoreInquiryRequest $request) {
        Inquiry::create($request->validated());

        return redirect()->route('inquiries.complete')
                         ->with('success', 'お問い合わせありがとうございました。');
    }

    public function complete() {
        return view('inquiries.complete');
    }
}