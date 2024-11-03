<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function authLogin() {
        if (!Session::get("adminUsername")) {
            return Redirect::to("/admin/login")->send();
        }
    }
    
    public function index() {
        $this->authLogin();
        $products = DB::table("products")
                      ->where("products.deleted", 0)
                      ->join("categories", "products.c_id", "=", "categories.c_id")
                      ->get();
        return view("admin.products.index", compact("products"));
    }

    public function showFormCreate() {
        $this->authLogin();
        $categories = DB::table("categories")->where("deleted", 0)->get();
        return view("admin.products.create", compact("categories"));
    }

    public function create(Request $req) {
        $this->authLogin();
        $data = array();
        $data["pro_name"] = $req->name;
        $data["pro_price"] = $req->price;
        $data["pro_description"] = $req->description;
        $data["c_id"] = $req->c_id;
        $data["outstanding"] = (int)$req->outstanding;

        $getImage = $req->file("image");
        if ($getImage) {
            $imageName = $getImage->getClientOriginalName();
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $imageName = "IMG_".date('Y-m-d-H-i-s')."_".$imageName;

            $getImage->move(public_path("FE\img\products"), $imageName);

            $data["pro_image"] = $imageName;
            DB::table("products")->insert($data);
            return Redirect::to("/admin/products");
            
        }

        $data["pro_image"] = "empty.jpg";
        DB::table("products")->insert($data);
        return Redirect::to("/admin/products");
    }

    public function showFormUpdate(Request $req) {
        $this->authLogin();
        $categories = DB::table("categories")->where("deleted", 0)->get();
        $product = DB::table("products")->where("pro_id", $req->id)->first();
        return view("admin.products.update", compact("product", "categories"));
    }

    public function update(Request $req) {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $this->authLogin();
        $data = array();
        $data["pro_name"] = $req->name;
        $data["pro_price"] = $req->price;
        $data["pro_description"] = $req->description;
        $data["c_id"] = $req->c_id;
        $data["outstanding"] = (int)$req->outstanding;
        $data["updated_at"] = date('Y-m-d H:i:s');

        $getImage = $req->file("image");
        if ($getImage) {
            $imageName = $getImage->getClientOriginalName();
            $imageName = "IMG_".date('Y-m-d-H-i-s')."_".$imageName;

            $getImage->move(public_path("FE\img\products"), $imageName);

            $data["pro_image"] = $imageName;
            DB::table("products")->where("pro_id", $req->id)->update($data);
            return Redirect::to("/admin/products");
            
        }
        DB::table("products")->where("pro_id", $req->id)->update($data);
        return Redirect::to("/admin/products");
    }

    public function delete(Request $req) {
        $this->authLogin();
        DB::table("products")->where("pro_id", $req->id)->update(["deleted" => 1]);
        return Redirect::to("/admin/products");
    }

    public function deleteManyItems(Request $req) {
        $this->authLogin();
        DB::table("products")->whereIn("pro_id", $req->products)->update(["deleted" => 1]);
        return Redirect::to("/admin/products");
    }
}
