<?php

namespace App\Http\Controllers;

use App\Filters\WebsiteFilters;
use App\Http\Requests\WebsiteSearchRequest;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{    
    /**
     * index
     *
     * @param  mixed $request
     * @param  mixed $filters
     * @return void
     */
    public function index(WebsiteSearchRequest $request, WebsiteFilters $filters)
    {
        $websites = Website::active()
            ->filter($filters)
            ->withCount(['posts', 'subscriptions'])
            ->paginate(10)
            ->withQueryString();

        $types = Website::select('type')
            ->distinct()
            ->get()
            ->pluck('type');

        return view('websites.index', compact('websites', 'types'));
    }
    
    /**
     * show
     *
     * @param  mixed $website
     * @return void
     */
    public function show(Website $website)
    {
        if (!$website->active) {
            abort(403);
        }
        
        $posts = $website->posts()->paginate(10);
        
        return view('websites.show', compact('website', 'posts'));
    }
}
