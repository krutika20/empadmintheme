<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use DB;

class EmailCustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emilcustom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send testing email in every 5 minutes';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $data = array('receiver'=>"Krutika Modi",'demo_one'=>'Demo 1','demo_two'=>"Demo 2",'sender'=>"Kruti Modi");
   
        Mail::send('mails.demo_plain', $data, function($message) {
            $message->to('krutika.m@crestinfosystems.net', 'Krutika Modi')->subject('Laravel Basic command scheduling Mail');
        });
        /*DB::table('demo')->insert(
            ['id' => 1, 'text' => 'test']
        );*/
    }
}
