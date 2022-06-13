<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgPassRequest;
use App\Services\KazInfoTehService;
use App\Helpers\Random;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('promoter.login');
    }

    public function login(LoginRequest $request)
    {
        $phone = $request->get('phone');
        $user = User::where('phone', $phone)
            ->first();

        if ($user) {
            $pass = Hash::check($request->get('pass'), $user->pass);

            if ($user->phone === $phone && $pass == true) {
                Auth::login($user);
                return response()->json(['route' => route('account')]);
            }

            $msg = trans('Неверный пароль. Используйте первоначально указанный номер телефона и пароль');
            return response()->json(['msg' => $msg], 401);
        }

        $msg = trans('Пользователя с таким номером не существует');
        return response()->json(['msg' => $msg], 401);
    }

    public function forgpass(ForgPassRequest $request, KazInfoTehService $sms)
    {
        $phone = $request->get('phone');
        $user = User::where('phone', $phone)
            ->first();

        if ($user) {

            $code = Random::gen(6);
            $pass = Hash::make($code);
            $message = trans('Ваша заявка на смену пароля в активности для Бизнес-Партнеров принята. Ваш новый пароль: :code', ['code' => $code]);
            if ($sms->sendMessage($phone, $message)) {
                $user->update(['pass' => $pass]);

                $msg = trans('Мы отправили Вам СМС с новым паролем');
                return response()->json(['msg' => $msg], 200);
            } else {
                $msg = trans('Ошибка отправки СМС');
                return response()->json(['msg' => $msg], 400);
            }

        }

        $msg = trans('Пользователя с таким номером не существует');
        return response()->json(['msg' => $msg], 401);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
