<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\CheckRequest;
use App\Services\KazInfoTehService;
use App\Helpers\Random;
use App\Helpers\uin\Age;
use App\Helpers\uin\Gender;

use App\Models\Consumer;
use App\Models\User;
use App\Models\Player;
use App\Models\Question;


class ConsumerController extends Controller
{
    public function language()
    {
        return view('consumer.language');
    }

    public function setlocale($locale)
    {
        if (array_search($locale, ['ru', 'kz']) !== false) {
            session()->put('locale', $locale);
        }
        return redirect()->route('consumer.registration_view');
    }

    public function registration()
    {
        return view('consumer.registration');
    }


    public function registration_check(RegistrationRequest $request)
    {
        $phone = $request->get('phone');
        $uin = $request->get('uin');

        $consumer = Consumer::where('uin', $uin)
            ->first();

        if ($consumer) {
            $msg = trans('Пользователь с такими данными уже зарегистрирован.');
            return response()->json(['msg' => $msg], 401);
        }

        session()->put('сonsumer', $request->all());
        return response()->json(['route' => route('consumer.sms_view')]);
    }

    public function sms_view(KazInfoTehService $sms)
    {
        if (session()->has('сonsumer') === false) {
            return redirect()->route('index');
        }

        $code = Random::gen(4);
        $message = trans('Ваша заявка на участие в активности принята. Ваш код: :code', ['code' => $code]);

        if (!config('app.debug')) {
            if ($sms->sendMessage(session('сonsumer.phone'), $message)) {
                session()->put('code', $code);
            }
        } else {
            Log::debug($message);
            session()->put('code', $code);
        }

        return view('consumer.verify_sms');
    }

    public function sms_reset(KazInfoTehService $sms)
    {
        $phone = session('сonsumer.phone');

        $code = Random::gen(4);
        $message = trans('Ваша заявка на участие в активности принята. Ваш код: :code', ['code' => $code]);
        if ($sms->sendMessage($phone, $message)) {
            $msg = trans('Мы отправили Вам СМС с новым кодом');
            return response()->json(['msg' => $msg], 200);
        } else {
            $msg = trans('Ошибка отправки СМС');
            return response()->json(['msg' => $msg], 400);
        }

        $msg = trans('Пользователя с таким номером не существует');
        return response()->json(['msg' => $msg], 401);

        return view('consumer.verify_sms');
    }

    public function sms_check()
    {
        $palyer = Player::where('uin', session('сonsumer.uin'))->first();

        // Вычисляем возраст и пол
        $age = Age::gen(session('сonsumer.uin'));
        $gender = Gender::gen(session('сonsumer.uin'));

        $var = Consumer::create([
            'uin' => session('сonsumer.uin'),
            'phone' => session('сonsumer.phone'),
            'fio' => $palyer->name,
            'city' => auth()->user()->city,
            'age' => $age,
            'gender' => $gender,
            'lang' => session('locale'),
            'ref_user_id' => auth()->user()->id
        ]);

        session()->put('сonsumer.id', $var->id);
        return response()->json(['route' => route('consumer.qest_view', 1)]);
    }

    
    public function qest_view($level)
    {
        $level_title = Question::where('id', $level)->first();
        $questions = Question::where('parent_id', $level)->get();

        if ($questions->isEmpty()) {
            $consumer = Consumer::find(session('сonsumer.id'));
            if ($consumer->question_id == NULL) {
                $consumer->question_id = $level;
                $consumer->save();
            }
            return redirect()->route('consumer.wheel_view');
        } else {
            return view('consumer.qest', [
                'level_title' => $level_title,
                'questions' => $questions,
                'locale' => session('locale'),
            ]);
        }
    }
}
