<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class ReviewController extends Controller
{
    public function authLogin() {
        if (!Session::get("adminUsername")) {
            return Redirect::to("/admin/login")->send();
        }
    }

    public function index()
    {
        $this->authLogin();
        $reviews = DB::table('reviews')->where('deleted', 0)->get(); // Lấy tất cả review chưa bị xóa
        return view('admin.reviews.index', compact('reviews'));
    }

    // Xóa một review
    public function delete(Request $request)
    {
        $this->authLogin();
        $reviewId = $request->query('r_id');
        DB::table('reviews')->where('r_id', $reviewId)->update(['deleted' => 1]);

        return redirect()->route('reviews.index')->with('success', 'Review đã được xóa thành công!');
    }

    // Xóa nhiều review cùng lúc
    public function deleteManyItems(Request $request)
    {
        $this->authLogin();
        $reviewIds = $request->input('reviews');
        if (!empty($reviewIds)) {
            DB::table('reviews')->whereIn('r_id', $reviewIds)->update(['deleted' => 1]);
        }

        return redirect()->route('reviews.index')->with('success', 'Các review đã được xóa thành công!');
    }
}
