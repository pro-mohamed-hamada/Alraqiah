<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;
use Carbon\Carbon;

class ComplaintsFilter extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function id($term)
    {
        return $this->builder->where('id',$term);
    }

    public function is_active($term)
    {
        return $this->builder->where('is_active',$term);
    }

    //TODO: check this filter in index blade this filter not work
    public function created_at($term)
    {
        return $this->builder->where('created_at', $term);
    }

    public function phone($term)
    {
        return $this->builder->whereHas('user', function ($query) use ($term) {
            $query->where('phone', $term);
        });
    }

    public function keyword($term)
    {
        return $this->builder->where('name', 'like', '%'.$term.'%');
    }

}
