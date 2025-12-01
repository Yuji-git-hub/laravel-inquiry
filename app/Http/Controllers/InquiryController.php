<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Mail\InquiryNotificationMail;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function index() {
        return view('inquiries.index');
    }

    public function store(StoreInquiryRequest $request) {

        $inquiry = Inquiry::create($request->validated());

        Mail::to('admin@example.com')->send(new InquiryNotificationMail($inquiry));

        return redirect()->route('inquiries.complete')
                         ->with('success', 'お問い合わせありがとうございました。');
    }

    public function complete() {
        return view('inquiries.complete');
    }
}