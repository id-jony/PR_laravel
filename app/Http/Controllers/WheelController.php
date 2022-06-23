<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Helpers\Random;

use App\Models\Consumer;
use App\Models\User;
use App\Models\Player;
use App\Models\Question;
use App\Models\Posm_delivery;
use App\Models\Posm;



class WheelController extends Controller
{
  public function index()
  {
    $consumer = Consumer::where('id', session('сonsumer.id'))
      ->first();

    if ($consumer->prize_id == NULL) {
      return view('consumer.wheel', [
        'consumer' => $consumer,
      ]);
    } else {
      return redirect()->route('account');
    }
  }

  public function wheel_ajax()
  {
    $posm_balances = Posm_delivery::where('user_id', auth()->user()->id)
      ->select(DB::raw('sum(count) as color, posm_id as text'))
      ->groupBy('text')
      ->having('color', '>=', '1')
      ->get();

    $n = 0;
    foreach ($posm_balances as $k => $posm_balance) {

        $posm = Posm::where('id', $posm_balance->text)
          ->first();
        $posm_balance->text = $posm->name;
        $posm_balance->image = $posm->image;
        $posm_balance->id = $posm->id;

        $n++;
        if ($n % 2 == 0) {
          $posm_balance->color = "hsl(221.97, 45.45%, 40.22%)";
        } else {
          $posm_balance->color = "hsl(212, 21%, 87%)";
        }
    
    }


    return response()->json($posm_balances, 200);
  }

  public function wheel_ajax_post(Request $reguest)
  {

    $consumer_delivery = new Posm_delivery();
    $consumer_delivery->user_id = auth()->user()->id;
    $consumer_delivery->posm_id = $reguest->prize_id;
    $consumer_delivery->consumer_id = session('сonsumer.id');
    $consumer_delivery->count = -1;
    $consumer_delivery->save();

    $consumer_prize = Consumer::find(session('сonsumer.id'));
    if ($consumer_prize->prize_id == NULL) {
      $consumer_prize->prize_id = $reguest->prize_id;
      $consumer_prize->save();
      $user = User::find(auth()->user()->id);
      $user->increment('posm_count');
    }
  }
}
