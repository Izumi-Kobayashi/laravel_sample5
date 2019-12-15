<?php

//namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers\Admin\Auth; // Adminを追加

use App\Http\Controllers\Admin\Auth;   // 追加
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Admin;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    public function showLoginForm()
    {
        return view('admin.login');
    }

    // ログイン画面
    public function login(Request $request)
    {
        // ブラウザから送られてきた、emailとpasswordを$credentials配列にまとめる
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // SessionGuardのattemptメソッドにname, passwordを渡して、DBに対象のユーザーが存在するか確かめる
        $loginIsSuccess = \Auth::guard('admin')->attempt($credentials);

        // ユーザーが存在した場合trueとなる
        if ($loginIsSuccess) {
            // セッションにトークンを再保存する
            $request->session()->regenerate();

            // メニュー一覧画面に遷移する
            return redirect(route('admin.menu_index'));
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
        \Auth::guard('admin')->logout();

        // セッション情報を削除
        $request->session()->invalidate();

        return redirect(route('admin.show_login_form'));
    }
}

