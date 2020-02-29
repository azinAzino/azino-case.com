<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendWS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:ws {$message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send to WS';

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
        $message = [
            'event' => 'loadLiveDrop',
            'data' => 'asdas'
        ];
        \App\Events\Message::dispatch($message);
    }
}
