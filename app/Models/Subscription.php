<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscription extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'website_id',
        'email',
    ];
    
    /**
     * website
     *
     * @return void
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

}
