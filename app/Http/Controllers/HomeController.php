<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class HomeController extends Controller
{
    public function authLogin()
    {
        if (!Session::get("username")) {
            return Redirect::to("/login")->send();
        }
    }

    public function index(Request $req)
    {
        if (!$req->category) {
            $active = 0;
            $products = DB::table("products")
                ->where("deleted", 0)
                ->get();
        } else {
            $active = $req->category;
            $products = DB::table("products")
                ->where("deleted", 0)
                ->where("c_id", $active)
                ->get();
        }

        $categories = DB::table("categories")->where("deleted", 0)->get();
        $outstandingProducts = DB::table("products")
            ->where("deleted", 0)
            ->where("outstanding", 1)
            ->get();

        return view("home.index", compact("products", "categories", "active", "outstandingProducts"));
    }

    public function products(Request $req)
    {
        if (!$req->category || $req->category == "all") {
            $active = 0;
            $products = DB::table("products")
                ->where("deleted", 0)
                ->get();
        } else {
            $active = $req->category;
            $products = DB::table("products")
                ->where("deleted", 0)
                ->where("c_id", $active)
                ->get();
        }

        $categories = DB::table("categories")->where("deleted", 0)->get();

        return view("home.products", compact("products", "categories", "active"));
    }

    public function about()
    {
        return view("home.about");
    }

    public function contact()
    {
        return view("home.contact");
    }

    public function details(Request $req)
    {
        $pro_id = $req->id;
        $result = DB::table("products")
            ->where("pro_id", $pro_id)
            ->where("deleted", 0)
            ->first();

        $relatedProducts = DB::table("products")
            ->where("deleted", 0)
            ->where("c_id", $result->c_id)
            ->get();

        $extraDishId = DB::table("categories")
            ->where("deleted", 0)
            ->where("c_name", "Món Thêm")
            ->select('c_id')
            ->first();

        $extraDish = DB::table("products")
            ->where("deleted", 0)
            ->where("c_id", $extraDishId->c_id)
            ->get();

        $totalReviews = DB::table("reviews")->where('pro_id', $pro_id)->count();
        $averageRating = DB::table("reviews")->where('pro_id', $pro_id)->avg('rating');

        $ratingBreakdown = DB::table("reviews")->where('pro_id', $pro_id)
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->all();

        $reviews = DB::table("reviews")
            ->join("accounts", "accounts.username", "=", "reviews.username")
            ->where('reviews.pro_id', $pro_id)
            ->get();

        for ($i = 1; $i <= 5; $i++) {
            if (!isset($ratingBreakdown[$i])) {
                $ratingBreakdown[$i] = 0;
            }
        }

        krsort($ratingBreakdown);

        return view("home.details", compact("result", "relatedProducts", "extraDish", "totalReviews", "averageRating", "ratingBreakdown", "reviews"));
    }

    public function showFormLogin()
    {
        return view("home.login");
    }

    public function showFormRegister()
    {
        return view("home.register");
    }

    public function register(Request $req)
    {
        $data = array();
        $data['username'] = $req->username;
        $data['password'] = md5($req->password);
        $data['fullname'] = $req->fullname;
        $data['gender'] = $req->gender;
        $data['birthday'] = $req->birthday;
        $data['email'] = $req->email;
        $data['phone'] = $req->phone;
        $data['address'] = $req->address;
        $data['role_id'] = 2;
        $check = DB::table("accounts")->where("username", $req->username)->where("deleted", 0)->first();

        $getImage = $req->file("avatar");
        if ($getImage) {
            $imageName = $getImage->getClientOriginalName();
            $imageName = "IMG_" . date('Y-m-d-H-i-s') . "_" . $imageName;

            $getImage->move(public_path("FE\img\avatars"), $imageName);

            if ($check) {
                Session::put("message", "Username đã tồn tại.");
                Session::put("msgType", "error");
                return Redirect::to("/register");
            } else {
                $data["avatar"] = $imageName;
                DB::table("accounts")->where("username", $req->username)->insert($data);
                Session::put("message", "Đăng ký tài khoản thành công.");
                Session::put("msgType", "success");
                return Redirect::to("/");
            }
        }

        if ($check) {
            Session::put("message", "Username đã tồn tại.");
            Session::put("msgType", "error");
            return Redirect::to("/register");
        } else {
            DB::table("accounts")->where("username", $req->username)->insert($data);
            Session::put("message", "Đăng ký tài khoản thành công.");
            Session::put("msgType", "success");
            return Redirect::to("/");
        }
    }

    public function login(Request $req)
    {
        $username = $req->username;
        $password = md5($req->password);

        $check = DB::table("accounts")
            ->where("username", $username)
            ->where("password", $password)
            ->where("role_id", 2)
            ->where("deleted", 0)
            ->first();

        if ($check) {
            Session::put("usernameField", null);
            Session::put("errorMessage", null);
            Session::put("username", $check->username);
            Session::put("userAccount", $check);

            return Redirect::to("/");
        } else {
            Session::put("errorMessage", "Username or password incorrect");
            Session::put("usernameField", $username);

            return Redirect::to("/login");
        }
    }

    public function logout()
    {
        $this->authLogin();
        Session::put("username", null);
        Session::put("fullname", null);
        return Redirect::to('/');
    }

    public function showFormChangePassword()
    {
        return view("home.changePassword");
    }

    public function changePassword(Request $req)
    {
        $oldPassword = $req->oldPassword;
        $newPassword = $req->newPassword;
        $check = DB::table("accounts")
            ->where("username", Session::get("username"))
            ->where("password", md5($oldPassword))
            ->where("deleted", 0)
            ->first();

        if ($check) {
            DB::table("accounts")
                ->where("username", Session::get("username"))
                ->where("deleted", 0)
                ->update(["password" => md5($newPassword), "updated_at" => now()]);

            Session::put("message", "Đổi mật khẩu thành công.");
            Session::put("msgType", "success");
            return Redirect::to("/");
        } else {
            Session::put("messageInvalidOldPassword", "Đổi mật khẩu thất bại. Mật khẩu cũ không đúng");
            return Redirect::to("/changePassword");
        }
    }

    public function search(Request $req)
    {
        $search = DB::table("products")
            ->where('pro_name', 'LIKE', '%' . $req->search . '%')
            ->where("deleted", 0)
            ->get();
        return view("home.search", ["search" => $search]);
    }

    public function profile()
    {
        $this->authLogin();
        return view("home.profile", ["account" => Session::get("userAccount")]);
    }

    public function showFormEditProfile()
    {
        $this->authLogin();
        return view("home.editProfile", ["account" => Session::get("userAccount")]);
    }

    public function editProfile(Request $req)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $this->authLogin();
        $data = array();
        $data["fullname"] = $req->fullname;
        $data["gender"] = $req->gender;
        $data["birthday"] = $req->birthday;
        $data["email"] = $req->email;
        $data["phone"] = $req->phone;
        $data["address"] = $req->address;
        $data["position"] = $req->position;
        $data["updated_at"] = date('Y-m-d H:i:s');

        $getImage = $req->file("avatar");
        if ($getImage) {
            $imageName = $getImage->getClientOriginalName();
            $imageName = "IMG_" . date('Y-m-d-H-i-s') . "_" . $imageName;

            $getImage->move(public_path("FE\img\avatars"), $imageName);

            $data["avatar"] = $imageName;
            DB::table("accounts")->where("username", Session::get("username"))->update($data);
            Session::put("userAccount", DB::table("accounts")->where("username", Session::get("username"))->first());
            Session::put("adminAccount", DB::table("accounts")->where("username", Session::get("adminUsername"))->first());
            return Redirect::to("/profile");
        }
        DB::table("accounts")->where("username", Session::get("username"))->update($data);
        Session::put("userAccount", DB::table("accounts")->where("username", Session::get("username"))->first());
        Session::put("adminAccount", DB::table("accounts")->where("username", Session::get("adminUsername"))->first());
        return Redirect::to("/profile");
    }

    public function myOrders()
    {
        $this->authLogin();
        $orderTables = DB::table('orders')
            ->orderBy('created_at', 'desc')
            ->where('deleted', 0)
            ->where('username', Session::get("username"))
            ->get();
        $orders = [];

        foreach ($orderTables as $orderItem) {
            $orderDetailTables = DB::table('order_details')
                ->join("orders", "order_details.o_id", "=", "orders.o_id")
                ->join("products", "order_details.pro_id", "=", "products.pro_id")
                ->where("order_details.o_id", $orderItem->o_id)
                ->get();
            $orders[] = $orderDetailTables;
        }

        return view("home.myOrders", compact("orders"));
    }

    public function myOrderDetails(Request $req)
    {
        $this->authLogin();

        $orderItem = DB::table('orders')
            ->where("o_id", $req->id)
            ->where('deleted', 0)
            ->first();

        $orderDetails = DB::table('order_details')
            ->join("orders", "order_details.o_id", "=", "orders.o_id")
            ->join("products", "order_details.pro_id", "=", "products.pro_id")
            ->where("order_details.o_id", $orderItem->o_id)
            ->get();

        return view("home.myOrderDetails", compact("orderDetails", "orderItem"));
    }

    public function submitReview(Request $req)
    {
        $this->authLogin();
        $username = Session::get("username");
        $o_id = $req->input('o_id');
        $ratings = $req->input('rating');
        $comments = $req->input('comment');
        $productIds = $req->input('pro_id');
        $data = [];

        foreach ($productIds as $index => $proId) {
            $data[] = [
                'o_id' => $o_id[$index],
                'pro_id' => $proId,
                'username' => $username,
                'rating' => $ratings[$index],
                'comment' => $comments[$index],
            ];
        }

        DB::table("reviews")->insert($data);
        DB::table("orders")->where("o_id", $o_id[0])->update(["status" => "Done"]);

        Session::put("message", "Đánh giá của bạn đã được ghi nhận.");
        Session::put("msgType", "success");
        return redirect()->back();
    }

    public function receivedStatus(Request $req) {
        DB::table("orders")->where("o_id", $req->id)->update(["status" => "To Review", 'updated_at' => now()]);
        return redirect()->back();
    }

    public function cancelOrder(Request $req) {
        DB::table("orders")->where("o_id", $req->id)->update(["status" => "To Cancel", "reason" => $req->reason, 'updated_at' => now()]);

        Session::put("message", "Hãy chờ phản hồi nhé.");
        Session::put("msgType", "success");
        return redirect()->back();
    }
}
