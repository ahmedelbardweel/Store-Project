<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReplyController extends Controller
{
    public function store(Request $request, Review $review)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $review->admin_reply = $request->reply;
        $review->save();

        return back()->with('success', 'تم إرسال الرد بنجاح.');
    }
}
