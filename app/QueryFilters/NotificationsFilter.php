<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class NotificationsFilter extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function id($term)
    {
        return $this->builder->where('id',$term);
    }

    public function user_id($term)
    {
        return $this->builder->where('user_id',$term);
    }

    public function keyword($term)
    {
        return $this->builder->where('name', 'like', '%'.$term.'%');
    }

}
