<?php


namespace App\Services\Viber;


use App\Services\SmsService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ViberDriver implements SmsService
{
    protected $baseUri = 'https://api-v2.hyber.im/';

    /**
     * @param $message
     * @return array|mixed
     */
    public function sendSms($message)
    {
        return Http::asForm()
            ->post(sprintf($this->baseUri.'%s', 1212), [
                'phone_number' => 380999807632,
                'channels'     => [
                   'viber'
                ],
                'channel_options' => [
                    'viber' => [
                        'text' => $message,
                        'ttl'  => 86400,
                    ]
                ],
            ])
            ->json();
    }
}
