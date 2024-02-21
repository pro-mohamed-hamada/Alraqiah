<?php

namespace App\Traits;

use App\Abstracts\QueryFilter;

trait IsActiveTrait
{

    public function getIsActiveAttribute()
   {
        return $this->getRawOriginal('is_active') ? __('lang.active') : __('lang.not_active');
   }

}
