<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('menu.login');
    }

    public function login(Request $request)
    {
        // ブラウザから送られてきた、emailとpasswordを$credentials配列にまとめる
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // SessionGuardのattemptメソッドにname, passwordを渡して、DBに対象のユーザーが存在するか確かめる
        $loginIsSuccess = \Auth::guard('user')->attempt($credentials);

        // ユーザーが存在した場合trueとなる
        if ($loginIsSuccess) {
            // セッションにトークンを再保存する
            $request->session()->regenerate();

            // 管理画面または一覧画面に遷移する
            return redirect(route('menu_index'));
        } else {
            // ユーザーが存在しなかった場合、例外を発生させログイン画面にエラー文を表示させる
            throw ValidationException::withMessages([
                'name' => 'ユーザー名またはパスワードが間違っています',
            ]);
        }
    }

    public function logout(Request $request)
    {
        // ログアウト
        \Auth::guard('user')->logout();

        // セッション情報を削除
        $request->session()->invalidate();

        return redirect(route('show_login_form'));
    }

}
