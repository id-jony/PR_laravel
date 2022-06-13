<?php

namespace App\Helpers\uin;

class Gender
{
  /**
   * Вычисление пола по ИИН
   *
   * @param integer $lenght
   * @return string
   */
  public static function gen($uin)
  {
    $result = '';

    $gender_value = substr($uin, 6, 1);

    if ($gender_value == 0 || $gender_value == 1 || $gender_value == 3 || $gender_value == 5) {
      $result = 'Мужчина';
    } else {
      $result = 'Женщина';
    }

    return $result;
  }
}
