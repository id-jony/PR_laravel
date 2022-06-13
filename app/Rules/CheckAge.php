<?php

namespace App\Rules;

use App\Helpers\uin\FioPost;
// use App\Helpers\uin\FioKompra;
// use App\Helpers\uin\FioFafa;
use App\Helpers\uin\ValidUin;
use App\Helpers\uin\Age;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckAge implements Rule
{
  public function passes($attribute, $value)
  {
    try {
      if (self::isValidUin($value)) {
        $uin = $value;
        $age = Age::gen($uin);

        if ($age >= 21) {
          if (!DB::table('players')->where('uin', $uin)->exists()) {
            return self::APIPost($uin);
          } else {
            return true;
          }
        }
      }
    } catch (Exception $e) {
    }
    return false;
  }

  private static function APIPost($uin)
  {
    $name = FioPost::gen($uin);
    if (!empty($name)) {
      DB::table('players')->insert(['uin' => $uin, 'name' => $name]);
      return true;
    } else {
      return false;
    }
  }

  private static function isValidUin($uin)
  {
      $v = ValidUin::gen($uin);
      if ($v == 1) {
        return true;
      } else {
        return false;
      }
  }

  // private static function APIKompra($uin)
  // {
  //     $name = FioKompra::gen($uin);
  //     if (!empty($name)) {
  //       DB::table('players')->insert(['uin' => $uin, 'name' => $name]);
  //       return true;
  //     } else {
  //       return self::APIPost($uin);
  //     }
  // }

  // private static function APIFaFa($uin)
  // {
  //   if (nova_get_setting('fafa_module') == 1) {
  //     $name = FioFafa::gen($uin);
  //     if (!empty($name)) {
  //       DB::table('players')->insert(['uin' => $uin, 'name' => $name]);
  //       return true;
  //     } else {
  //       return false;
  //     }
  //   } else {
  //     return true;
  //   }
  // }

  public function message()
  {
    return trans('Неверно указан ИИН. Если вы уверены (-а), что ИИН указан верно, то можешь позвонить на нашу горячую линию') . ' <a href="tel:5757">5757</a>';
  }

}
