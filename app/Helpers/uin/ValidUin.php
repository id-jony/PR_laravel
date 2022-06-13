<?php

namespace App\Helpers\uin;

use Exception;
use Illuminate\Support\Facades\Log;

class ValidUin
{
  /**
   * Вычисление ФИО по ИИН
   *
   * @param integer $lenght
   * @return string
   */
  public static function gen($uin)
  {
    $result = 0;

    if (preg_match('#^\d{12,12}$#', $uin)) {
      //Проверяем контрольный разряд
      $b1 = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
      $b2 = array(3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 2);
      $a = array();
      $controll = 0;

      for ($i = 0; $i < 12; $i++) {
        $a[$i] = substr($uin, $i, 1);
        if ($i < 11) {
          $controll += $a[$i] * $b1[$i];
        }
      }

      $controll = $controll % 11;

      if ($controll == 10) {
        $controll = 0;
        for ($i = 0; $i < 11; $i++) {
          $controll += $a[$i] * $b2[$i];
        }
        $controll = $controll % 11;
      }

      if ($controll == $a[11]) {
        $result = 1;
      }
    }

    return $result;
  }
}
