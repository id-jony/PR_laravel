<?php

namespace App\Helpers\uin;

class Age
{
  /**
   * Вычисление возвраста по ИИН
   *
   * @param integer $lenght
   * @return string
   */
  public static function gen($uin)
  {
    $result = '';

    // Вычисляем возвраст по ИИН
    $value = $uin;
    $value = preg_replace('/(\d{2})(\d{2})(\d{2})/', '$1-$2-$3', substr($value, 0, 6));
    $today = now()->today();
    $date = now()->setDateFrom($value);
    $result = $today->diff($date)->format('%Y');

    return $result;
  }
}
