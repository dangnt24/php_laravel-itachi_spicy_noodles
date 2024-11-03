<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function authLogin() {
        if (!Session::get("adminUsername")) {
            return Redirect::to("/admin/login")->send();
        }
    }


    public function index() {
        $this->authLogin();
        return view("admin.index");
    }

    public function showFormLogin() {
        return view("admin.login");
    }

    public function login(Request $req) {
        $check = DB::table("accounts")
                 ->where("username", $req->username)
                 ->where("password", md5($req->password))
                 ->where("role_id", 1)
                 ->where("deleted", 0)
                 ->first();

        if ($check) {
            Session::put('adminUsername', $check->username);
            Session::put('adminAccount', $check);

            return Redirect::to("/admin");
        } else {
            Session::put("errorMessage", "Username or password incorrect");
            Session::put("usernameField", $req->username);

            return Redirect::to("/admin/login");
        }
    }

    public function logout() {
        Session::put('adminUsername', null);
        Session::put('adminFullname', null);
        Session::put('adminAvatar', null);
        return Redirect::to("/admin/login");
    }

    public function profile() {
        $user = DB::table("accounts")->where("username", Session::get("adminUsername"))->first();
        return view("admin.profile", compact("user"));
    }

    public function showFormChangePassword() {
        return view("admin.changePassword");
    }

    public function changePassword(Request $req) {
        $oldPassword = $req->oldPassword;
        $newPassword = $req->newPassword;
        $check = DB::table("accounts")
                ->where("username", Session::get("adminUsername"))
                ->where("password", md5($oldPassword))
                ->where("deleted", 0)
                ->first();

        if ($check) {
            DB::table("accounts")
                ->where("username", Session::get("adminUsername"))
                ->where("deleted", 0)
                ->update(["password" => md5($newPassword), "updated_at" => now()]);

            Session::put("message", "Đổi mật khẩu thành công.");
            Session::put("msgType", "success");
            return Redirect::to("/admin");
        } else {
            Session::put("messageInvalidOldPassword", "Đổi mật khẩu thất bại. Mật khẩu cũ không đúng");
            return Redirect::to("/admin/changePassword");
        }
    }
}
