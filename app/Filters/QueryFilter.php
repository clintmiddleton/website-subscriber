<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{    
    /**
     * request
     *
     * @var mixed
     */
    protected $request;
    
    /**
     * builder
     *
     * @var mixed
     */
    protected $builder;

    /**
     * QueryFilter constructor.
     *
     * @param $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * apply
     *
     * @param  mixed $builder
     * @return void
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        if (!$this->filters()) {
            return $builder;
        }
        
        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                if (trim($value)) {
                    $this->$name($value);
                } else {
                    $this->$name();
                }
            }
        }

        return $builder;
    }
    
    /**
     * filters
     *
     * @return void
     */
    public function filters()
    {
        return $this->request->all();
    }
}
