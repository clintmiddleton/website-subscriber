<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Exception;

class PostSlugObserver
{    
    /**
     * attribute
     *
     * @var string
     */
    protected $attribute = 'title';
        
    /**
     * unique
     *
     * @var bool
     */
    protected $unique = true;
    
    /**
     * creating
     *
     * @param  mixed $model
     * @return void
     */
    public function creating($model)
    {
        $this->updateSlug($model);
    }
    
    /**
     * updating
     *
     * @param  mixed $model
     * @return void
     */
    public function updating($model)
    {
        $this->updateSlug($model);
    }
    
    /**
     * updateSlug
     *
     * @param  mixed $model
     * @param  mixed $suffix
     * @return void
     */
    private function updateSlug($model, $suffix = 0)
    {
        $slug = $this->calculateSlug($model, $suffix);
        
        if (!$this->unique) {
            $model->slug = $slug;
            return;
        }

        $exists = $model::where('slug', $slug)->where('id', '!=', $model->id)->exists();

        if (!$exists) {
            $model->slug = $slug;
            return;
        }

        $this->updateSlug($model, $suffix ? $suffix+1 : 1);
    }
    
    /**
     * calculateSlug
     *
     * @param  mixed $model
     * @param  mixed $suffix
     * @return void
     */
    private function calculateSlug($model, $suffix = 0)
    {
        $slug = Str::slug($model->{$this->attribute});

        if (!$suffix) {
            return $slug;
        }

        return "$slug-$suffix";
    }
}
