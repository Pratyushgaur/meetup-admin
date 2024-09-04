<?php

namespace App\Listeners;

use App\Events\InfluencerSetup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\DefaultService;
use App\Models\DefaultPlan;
use App\Models\Service;

class InfluencerSetupListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InfluencerSetup $event): void
    {
        
        $services = DefaultService::get();
        foreach($services as $key =>$value){
            Service::create([
                'influencer_id' => $event->userId,
                'service_type' => $value->service_type,
                'price' => $value->price,
            ]);
        }

        // $plans = DefaultPlan::get();
        // foreach($plans as $key =>$value){
        //     Service::create([
        //         'influencer_id' => $event->userId,
        //         'service_type' => $value->service_type,
        //         'price' => $value->price,
        //     ]);
        // }

    }
}
