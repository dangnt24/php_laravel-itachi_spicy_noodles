<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
session_start();
use DateTime;

class CartController extends Controller
{
    public function authLogin() {
        if (!Session::get("username")) {
            return Redirect::to("/login")->send();
        }
    }

    public function cart(Request $req) {
        $this->authLogin();
        if($req->action) {
            $cart = Session::get("cart");
            $key = $req->key;

            if($req->action == "increase") {
                $cart[$key]["quantity"]++;
                $cart[$key]["total_money"] = $cart[$key]["price"] * $cart[$key]["quantity"];
            }else if($req->action == "decrease") {
                if ($cart[$key]["quantity"]>1) {
                    $cart[$key]["quantity"]--;
                    $cart[$key]["total_money"] = $cart[$key]["price"] * $cart[$key]["quantity"];
                }
            }

            Session::put("cart", $cart);
            return Redirect::to("/cart");
        } else if($req->key || $req->key==0) {
            $cart = Session::get("cart");
            unset($cart[$req->key]);

            Session::put("cart", $cart);
            return view("home.cart");
        } else {
            return view("home.cart");
        }
    }

    public function prepareCheckOut(Request $req) {
        $this->authLogin();
        $cart = Session::get("cart");
        $pro_id = (int)$req->pro_id;
        $product = DB::table("products")
                    ->where("pro_id", $pro_id)
                    ->where("deleted", 0)
                    ->first();
        $level = (int)$req->level;
        $isFresh = (int)$req->isFresh;
        $note = $req->note;
        $price = $req->price;
        $quantity = (int)$req->quantity;

        if (!$cart) {
            $data = array();
            $item = array();

            $item["pro_id"] = $pro_id;
            $item["title"] = $product->pro_name;
            $item["image"] = $product->pro_image;
            $item["price"] = $price;
            $item["quantity"] = $quantity;
            $item["level"] = $level;
            $item["isFresh"] = $isFresh;
            $item["note"] = $note;
            $item["total_money"] = $price * $quantity;

            array_push($data, $item);

            Session::put("cart", $data);
            Session::put("message", "Sản phẩm đã thêm vào giỏ.");
            Session::put("msgType", "success");
        } else {
            foreach($cart as $key => $item) {
                if ($item['pro_id'] == $pro_id && $item['level'] == $level && $item['isFresh'] == $isFresh && $item['note'] == $note) {
                    $check = false;
                    $cart[$key]['quantity'] += $quantity;
                    $cart[$key]['total_money'] = $cart[$key]['price'] * $cart[$key]['quantity'];

                    Session::put("cart", $cart);
                    Session::put("message", "Sản phẩm đã thêm vào giỏ.");
                    Session::put("msgType", "success");
                    if ($req->addcart) {
                        return Redirect::to("/details?id=".$pro_id);
                    } else {
                        return Redirect::to("/cart");
                    }
                }
            }

            $item = array();

            $item["pro_id"] = $pro_id;
            $item["title"] = $product->pro_name;
            $item["image"] = $product->pro_image;
            $item["price"] = $price;
            $item["quantity"] = $quantity;
            $item["level"] = $level;
            $item["isFresh"] = $isFresh;
            $item["note"] = $note;
            $item["total_money"] = $price * $quantity;

            array_push($cart, $item);
            Session::put("cart", $cart);
            Session::put("message", "Sản phẩm đã thêm vào giỏ.");
            Session::put("msgType", "success");
        }

        if ($req->addcart) {
            return Redirect::to("/details?id=".$pro_id);
        } else {
            return Redirect::to("/cart");
        }
    }

    public function toPayment(Request $req) {
        if (Session::get("cart")) {
            $total_pay = $req->total_pay;
            $username = $req->username;
            $user = DB::table("accounts")->where("username", $username)->first();

            return view("home.payment", compact("total_pay", "user"));
        }
    }

    public function payment(Request $req) {
        $total_pay = $req->total_pay;
        $username = $req->username;
        $cart = Session::get("cart");
        $currentDate = new DateTime();
        $currentDate->modify('+3 days');
        $delivery_date = $currentDate->format('Y-m-d H:i:s');


        $data = array();
        $data["username"] = $username;
        $data["total_pay"] = $total_pay;
        $data["status"] = "Initialized";
        $data['fullname'] = $req->fullname;
        $data['phone'] = $req->phone;
        $data['address'] = $req->address;
        $data['order_note'] = $req->order_note;
        $data['delivery_method'] = $req->deliveryMethod;
        $id = DB::table("orders")->insertGetId($data);

        foreach($cart as $item) {
            $detail = array();
            $detail['o_id'] = $id;
            $detail['pro_id'] = $item['pro_id'];
            $detail['price'] = $item['price'];
            $detail['quantity'] = $item['quantity'];
            $detail['level'] = $item['level'];
            $detail['isFresh'] = $item['isFresh'];
            $detail['note'] = $item['note'];

            DB::table("order_details")->insert($detail);
        }

        Session::put("cart", null);
        Session::put("message", "Đặt hàng thành công! Hãy theo dõi tiến trình đơn hàng nhé.");
        Session::put("msgType", "success");
        return Redirect::to("/");
    }

    public function deleteManyItems(Request $req) {
            $cart = Session::get("cart");
        foreach($req->keys as $key) {
            unset($cart[$key]);
        }
        Session::put("cart", $cart);
        return view("home.cart");
}
}
