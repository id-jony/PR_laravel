<?php

namespace App\Services;

use Exception;
use SoapClient;
use Illuminate\Support\Facades\Log;

/**
 * KazInfoTehService class
 */
class KazInfoTehService
{
  /**
   * @var array
   */
  private $config = [];

  /**
   * @var SoapClient
   */
  private $client;

  const PRIORITY = [
    'low' => 1,
    'middle' => 2,
    'high' => 3,
  ];

  public function __construct(array $config)
  {
    $this->config = $config;
    $this->client = new SoapClient($this->config['wsdl'], [
      'connection_timeout' => 1000,
      'trace' => 1,
      'exception' => 1,

      'verifypeer' => false,
      'verifyhost' => false,
      'stream_context' => stream_context_create(
        [
          'ssl' => [
            'verify_peer'       => false,
            'verify_peer_name'  => false,
          ]
        ]
      )

    ]);
  }


  /**
   * SendMessage
   *
   * @param string $phone
   * @param string $message
   * @return boolean
   *
   * @throws Exception
   */
  public function sendMessage(string $phone, string $message): bool
  {
    $phone = preg_replace('/[^\d]/', '', $phone);

    $data = [
      'login' => $this->config['login'],
      'password' => $this->config['password'],
      'sms' => [
        'recepient' => $phone,
        'senderid' => $this->config['sender_id'],
        'msg' => $message,
        'scheduled' => '',
        'UserMsgID' => '',
        'msgtype' => 0,
        'prioritet' => self::PRIORITY['high'],
      ]
    ];

    if (app()->environment('local')) {
      logger()->debug('Send message', $data);
      return true;
    }

    $result = $this->client->SendMessage($data)->Result;
    Log::channel('single')->debug($data);
    Log::channel('single')->debug($result->Status);

    if ($result->Status !== 'Ok') {
      throw new Exception($result->Status);
    }

    return true;
  }
}
