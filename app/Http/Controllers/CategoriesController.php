<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoriesController extends Controller
{
    public function authLogin() {
        if (!Session::get("adminUsername")) {
            return Redirect::to("/admin/login")->send();
        }
    }
    
    public function index() {
        $this->authLogin();
        $categories = DB::table("categories")
                      ->where("deleted", 0)
                      ->get();
        return view("admin.categories.index", compact("categories"));
    }

    public function showFormCreate() {
        $this->authLogin();
        return view("admin.categories.create");
    }

    public function create(Request $req) {
        $this->authLogin();
        $check = DB::table("categories")->where("c_name", $req->c_name)->where("deleted", 0)->first();
        if ($check) {
            return view("admin.categories.create")->with("message", "This category already exists.");
        } else {
            DB::table("categories")->insert(["c_name" => $req->c_name]);
        }
        return Redirect::to("/admin/categories");
    }

    public function showFormUpdate(Request $req) {
        $this->authLogin();
        $category = DB::table("categories")->where("c_id", $req->c_id)->first();
        return view("admin.categories.update", compact("category"));
    }

    public function update(Request $req) {
        $this->authLogin();
        DB::table("categories")->where("c_id", $req->c_id)->update(["c_name" => $req->c_name, "updated_at" => now()]);
        return Redirect::to("/admin/categories");
    }

    public function delete(Request $req) {
        $this->authLogin();
        DB::table("categories")->where("c_id", $req->c_id)->update(["deleted" => 1]);
        return Redirect::to("/admin/categories");
    }

    public function deleteManyItems(Request $req) {
        $this->authLogin();
        DB::table("categories")->whereIn("c_id", $req->categories)->update(["deleted" => 1]);
        return Redirect::to("/admin/categories");
    }
}
