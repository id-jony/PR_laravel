<?php

namespace App\Helpers;

class Random
{
  /**
   * Генерация случайного числа
   *
   * @param integer $lenght
   * @return string
   */
  public static function gen(int $lenght = 8): string
  {
    $result = '';

    for ($i = 0; $i < $lenght; $i++) {
      $result .= random_int(0, 9);
    }

    return $result;
  }
}
