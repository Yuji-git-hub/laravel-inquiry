<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;

class AdminController extends Controller
{
    public function index() {
        $inquiries = Inquiry::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.index', ['inquiries' => $inquiries]);
    }

    public function show($id) {
        $inquiry = Inquiry::findOrFail($id);

        return view('admin.show', ['inquiry' => $inquiry]);
    }
}
