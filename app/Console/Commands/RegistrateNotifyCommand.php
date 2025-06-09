<?php

namespace App\Console\Commands;

use App\Http\Services\RabbitmqService;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RegistrateNotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:registrate-notify-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private RabbitmqService $rabbitmqService;
    public function __construct(RabbitmqService $rabbitmqService)
    {
        parent::__construct();
        $this->rabbitmqService = $rabbitmqService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $callback = function ($msg) {
            $data = json_decode($msg->body, true);
            print_r($data);

            if (!isset($data['user_id'])) {
                dump('Ошибка: user_id не найден', $data);
                return;
            }

            $user = User::query()->find($data['user_id']);
            Mail::to($user->email)->send(new TestMail(['name' => $user->name]));
        };
        echo 'test';

        $this->rabbitmqService->consume('registrate_email', $callback);
    }
}
