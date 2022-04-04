<?php

namespace App\Console\Commands;

use App\Mail\AdsRemainders;
use App\Models\Ad;
use App\Models\Advertiser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AdsRemaindersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ads_remainders_command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ads daily remainder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $advertisers = Advertiser::with('ads')->whereHas('ads',function ($q){
            $q->whereDate('start_date','=',Carbon::tomorrow()->format('Y-m-d'));
        })->get();
        foreach ($advertisers as $advertiser){
            Mail::to($advertiser)->send(new AdsRemainders($advertiser));
        }
    }
}
