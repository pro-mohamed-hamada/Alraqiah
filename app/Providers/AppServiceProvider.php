<?php

namespace App\Providers;

use App\Enum\ActivationStatusEnum;
use App\Models\Rate;
use App\Observers\refreshRateObserver;
use App\Services\ComplaintService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('activeComplaints', function ($app) {
            // Perform the heavy operation or fetch the data here. Example:
            $activeComplaints = app()->make(ComplaintService::class)->queryGet(filters: ["is_active"=>ActivationStatusEnum::ACTIVE])->count();

            return $activeComplaints;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Rate::observe(refreshRateObserver::class);
    }
}
