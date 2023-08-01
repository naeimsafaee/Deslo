<?php

namespace App\Console\Commands;

use App\Notifications\SendSMS;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendSmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle(){

        $instramental = DB::table('client_to_installments')->whereDate('time', '>=', Carbon::today()->subDays(7))->get();

        foreach($instramental as $item){
            $client = $item->client;

            $client->notify(new SendSMS($client->phone, "احتراما سررسید قسط شما تا ۷ روز دیگر فرا می رسد.". PHP_EOL . "دسلو" , true));
        }

        return 0;
    }
}
