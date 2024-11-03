<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class AccountController extends Controller
{
    public function authLogin() {
        if (!Session::get("adminUsername")) {
            return Redirect::to("/admin/login")->send();
        }
    }
    
    public function index() {
        $this->authLogin();
        $accounts = DB::table("accounts")
                      ->where("deleted", 0)
                      ->get();
        return view("admin.accounts.index", compact("accounts"));
    }

    public function showFormCreate() {
        $this->authLogin();
        $roles = DB::table("roles")->where("deleted", 0)->get();
        return view("admin.accounts.create", compact("roles"));
    }

    public function create(Request $req) {
        $this->authLogin();
        $data = array();
        $data["username"] = $req->username;
        $data["password"] = md5($req->password);
        $data["fullname"] = $req->fullname;
        $data["gender"] = $req->gender;
        $data["birthday"] = $req->birthday;
        $data["email"] = $req->email;
        $data["phone"] = $req->phone;
        $data["address"] = $req->address;
        $data["role_id"] = $req->role_id;
        $data["position"] = $req->position;
        $check = DB::table("accounts")->where("username", $req->username)->where("deleted", 0)->first();

        $getImage = $req->file("avatar");
        if ($getImage) {
            $imageName = $getImage->getClientOriginalName();
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $imageName = "IMG_".date('Y-m-d-H-i-s')."_".$imageName;

            $getImage->move(public_path("FE\img\avatars"), $imageName);

            if ($check) {
                Session::put("message", "Username already exists.");
                Session::put("msgType", "error");
                return Redirect::to("/admin/accounts");
            } else {
                $data["avatar"] = $imageName;
                DB::table("accounts")->insert($data);
                return Redirect::to("/admin/accounts");
            }
            
        }

        if ($check) {
            Session::put("message", "Username already exists.");
            Session::put("msgType", "error");
            return Redirect::to("/admin/accounts/create");
        } else {
            $data["avatar"] = "user.png";
            DB::table("accounts")->insert($data);
            return Redirect::to("/admin/accounts");
        }
    }

    public function showFormUpdate(Request $req) {
        $this->authLogin();
        $account = DB::table("accounts")->where("username", $req->username)->first();
        return view("admin.accounts.update", compact("account"));
    }

    public function update(Request $req) {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $this->authLogin();
        $data = array();
        $data["username"] = $req->username;
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
            $imageName = "IMG_".date('Y-m-d-H-i-s')."_".$imageName;

            $getImage->move(public_path("FE\img\avatars"), $imageName);

            $data["avatar"] = $imageName;
            DB::table("accounts")->where("username", $req->username)->update($data);
            Session::put("userAccount", DB::table("accounts")->where("username", Session::get("username"))->first());
            Session::put("adminAccount", DB::table("accounts")->where("username", Session::get("adminUsername"))->first());
            return Redirect::to("/admin/accounts");
            
        }
        DB::table("accounts")->where("username", $req->username)->update($data);
            Session::put("userAccount", DB::table("accounts")->where("username", Session::get("username"))->first());
            Session::put("adminAccount", DB::table("accounts")->where("username", Session::get("adminUsername"))->first());
        return Redirect::to("/admin/accounts");
    }

    public function delete(Request $req) {
        $this->authLogin();
        DB::table("accounts")->where("username", $req->username)->update(["deleted" => 1]);
        return Redirect::to("/admin/accounts");
    }

    public function deleteManyItems(Request $req) {
        $this->authLogin();
        if ($req->filled("accounts")) {
            DB::table("accounts")->whereIn("username", $req->accounts)->update(["deleted" => 1]);
        }
        return Redirect::to("/admin/accounts");
    }
}
