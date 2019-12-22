<?php

namespace App\Console\Components\Twitter;

use Illuminate\Console\Command;
use App\Events\Twitter\Mentioned;
use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApi;

class ListenForMentionsCommand extends Command
{
    protected $signature = 'dashboard:listen-twitter-mentions';

    protected $description = 'Listen for mentions on Twitter';

    public function handle()
    {
        $this->info('Listening for mentions...');

        app(TwitterStreamingApi::class)
            ->publicStream()
            ->whenHears([
                'miguelpiedrafita.com',
                '@m1guelpf',
                'sitesauce.app',
                '@sitesauce',
            ], function (array $tweetProperties) {
                event(new Mentioned($tweetProperties));
            })
            ->startListening();
    }
}
