<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebsiteResource;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebsiteApiController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return WebsiteResource::collection(Website::active()->get());
    }
}
