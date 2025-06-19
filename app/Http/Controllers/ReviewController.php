<?php

// app/Http/Controllers/ReviewController.php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000'
        ]);

        // إذا كنت تريد منع التعليق إلا مرة واحدة لكل منتج لكل مستخدم:
        // Review::where('user_id', auth()->id())->where('product_id', $productId)->delete();

        Review::create([
            'user_id'    => auth()->id(),
            'product_id' => $productId,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);
        return back()->with('success', 'تم إضافة تقييمك بنجاح!');
    }

    // app/Http/Controllers/ReviewController.php

    public function reply(Request $request, $review_id)
    {
        $request->validate([
            'reply' => 'required|string|max:2000'
        ]);

        $review = Review::findOrFail($review_id);
        // تحقق أن المستخدم أدمن
        if(auth()->user()->role !== 'admin') {
            abort(403);
        }
        $review->replies()->create([
            'user_id' => auth()->id(),
            'reply' => $request->reply
        ]);

        return back()->with('success', 'تم إضافة ردك على التعليق');
    }

    public function userReply(Request $request, $reviewId)
    {
        $review = Review::findOrFail($reviewId);
        if (auth()->id() != $review->user_id) abort(403);

        $request->validate(['user_reply_to_admin' => 'required|string|max:500']);
        $review->user_reply_to_admin = $request->user_reply_to_admin;
        $review->save();

        return back()->with('success', 'تم إضافة ردك على الإدارة.');
    }


}

