<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class OrderController extends Controller
{
    public function authLogin() {
        if (!Session::get("adminUsername")) {
            return Redirect::to("/admin/login")->send();
        }
    }

    public function index() {
        $this->authLogin();
        $orders = DB::table("orders")->join("accounts", "orders.username", "=", "accounts.username")->where("orders.deleted", 0)->get();
        return view("admin.orders.index", compact("orders"));
    }

    public function showFormUpdate(Request $req) {
        $this->authLogin();

        $orderItem = DB::table('orders')
            ->where("o_id", $req->id)->first();

        $orderDetails = DB::table('order_details')
            ->join("orders", "order_details.o_id", "=", "orders.o_id")
            ->join("products", "order_details.pro_id", "=", "products.pro_id")
            ->where("order_details.o_id", $orderItem->o_id)
            ->get();

        return view("admin.orders.update", compact("orderDetails", "orderItem"));
    }

    public function update(Request $request) {
        $this->authLogin();
        DB::table('orders')->where('o_id', $request->o_id)->update([
            'total_pay' => $request->total_pay,
            'order_note' => $request->order_note,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
            'delivery_method' => $request->delivery_method,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return Redirect::to("/admin/orders/general");
    }

    public function delete(Request $req) {
        $this->authLogin();
        DB::table("orders")->where("o_id", $req->id)->update(["deleted" => 1]);
        return Redirect::to("/admin/orders/general");
    }

    public function deleteManyItems(Request $req) {
        $this->authLogin();
        DB::table("orders")->whereIn("o_id", $req->orders)->update(["deleted" => 1]);
        return Redirect::to("/admin/orders/general");
    }

    public function confirmOrder()
    {
        $this->authLogin();
        $orders = DB::table('orders')->where('status', 'Initialized')->get();

        return view('admin.orders.confirmOrder', compact('orders'));
    }

    public function confirmOrderStatus(Request $request)
    {
        $this->authLogin();
        DB::table('orders')->where('o_id', $request->id)->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return Redirect::to("/admin/orders/general");
    }

    public function confirmCancelOrder() {
        $this->authLogin();
        $orders = DB::table('orders')->where('status', 'To Cancel')->get();

        return view('admin.orders.confirmCancelOrder', compact('orders'));
    }

    public function confirmCancelOrderStatus(Request $request)
    {
        $this->authLogin();
        DB::table('orders')->where('o_id', $request->id)->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return Redirect::to("/admin/orders/general");
    }

    public function deliveryStatusUpdate(Request $request) {
        $this->authLogin();

        if ($request->status == "Initialized") {
            Session::put("message", "Please confirm your order before delivery this order.");
            Session::put("msgType", "error");

            return Redirect::to("/admin/orders/confirmOrder");
        }

        DB::table('orders')->where('o_id', $request->id)->update([
            'status' => 'To Receive',
            'updated_at' => now(),
        ]);

        return Redirect::to("/admin/orders/general");
    }
}
