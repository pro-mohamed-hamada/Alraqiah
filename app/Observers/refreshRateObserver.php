<?php

namespace App\Observers;

use App\Models\Rate;
use App\Models\Setting;

class refreshRateObserver
{
    /**
     * Handle the Rate "created" event.
     */
    public function created(Rate $rate): void
    {
        $rates = Rate::selectRaw('COUNT(*) as ratesCount, SUM(rate_number) as totalRateNumber')->first();
        $finaleRate = round(($rates->totalRateNumber / $rates->ratesCount) * 2) / 2;
        $setting = Setting::first();
        $setting->update(['rate'=>$finaleRate]);
    }

    /**
     * Handle the Rate "updated" event.
     */
    public function updated(Rate $rate): void
    {
        $rates = Rate::selectRaw('COUNT(*) as ratesCount, SUM(rate_number) as totalRateNumber')->first();
        $finaleRate = round(($rates->totalRateNumber / $rates->ratesCount) * 2) / 2;
        $setting = Setting::first();
        $setting->update(['rate'=>$finaleRate]);

    }

    /**
     * Handle the Rate "deleted" event.
     */
    public function deleted(Rate $rate): void
    {
        $rates = Rate::selectRaw('COUNT(*) as ratesCount, SUM(rate_number) as totalRateNumber')->first();
        $finaleRate = round(($rates->totalRateNumber / $rates->ratesCount) * 2) / 2;
        $setting = Setting::first();
        $setting->update(['rate'=>$finaleRate]);

    }

    /**
     * Handle the Rate "restored" event.
     */
    public function restored(Rate $rate): void
    {
        //
    }

    /**
     * Handle the Rate "force deleted" event.
     */
    public function forceDeleted(Rate $rate): void
    {
        //
    }
}
