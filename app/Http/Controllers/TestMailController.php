<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class TestMailController
{
    public function send()
    {
        $data = ['name' => 'Heshegte'];

        Mail::to('heshegte1997@mail.ru')->send(new TestMil($data));

        echo 'Письмо успешно отправлено';
    }
}
