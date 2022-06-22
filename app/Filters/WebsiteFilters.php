<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WebsiteFilters extends QueryFilter
{    
    /**
     * search
     *
     * @param  mixed $search
     * @return void
     */
    public function search($search = null)
    {
        if ($search) {
            return $this->builder->where('name', 'like', '%' . $search . '%');
        }
    }
    
    /**
     * type
     *
     * @param  mixed $type
     * @return void
     */
    public function type($type = null)
    {
        if ($type) {
            return $this->builder->where('type', strtolower($type));
        }
    }
}
