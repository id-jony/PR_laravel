<?php

namespace App\Helpers\uin;

use GuzzleHttp\Client;

use Exception;
use Illuminate\Support\Facades\Log;

class FioPost
{
  /**
   * Вычисление ФИО по ИИН
   *
   * @param integer $lenght
   * @return string
   */
  public static function gen($uin)
  {
    $result = '';

    try {
      $client = new Client();
      $url = 'https://post.kz/mail-app/api/checkIinBin';
      $response = $client->request('POST', $url, ['json' => ['iinBin' => $uin]]);
      $responseJSON = $response->getBody();
      $responseObject = json_decode($responseJSON, true);
      $name = $responseObject['fio'];

      if ($responseObject['iinBin'] == $uin) {
        if (!empty($name)) {
          $result = $name;
        }
      } else {
        Log::channel('uin-errors')->debug($uin . ' (error Post.kz): ' . $responseJSON);
      }
    } catch (\Exception $error) {
      $data_decode = json_decode($error->getResponse()->getBody());
      // Log::channel('uin-errors')->debug($uin.' (error Post.kz): '.$data_decode->status);
      Log::channel('uin-errors')->debug($uin . ' (error Post.kz): ' . $data_decode->messageRu);
      // Log::channel('uin-errors')->debug($uin.' (error Post.kz): '.$error->getResponse());
      // Log::channel('uin-errors')->debug($uin.' (error Post.kz): '.$error->getBody());
    }

    return $result;
  }
}
