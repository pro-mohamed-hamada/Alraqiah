<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class ClientsFilter extends QueryFilter
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

    public function parent_id($term)
    {
        return $this->builder->where('parent_id',$term);
    }

    public function name($term)
    {
        return $this->builder->where('name',$term);
    }

    public function phone($term)
    {
        return $this->builder->where('phone', $term);
    }

    public function keyword($term)
    {
        return $this->builder->where('name', 'like', '%'.$term.'%');
    }

}
