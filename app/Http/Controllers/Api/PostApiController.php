<?php

namespace App\Http\Controllers\Api;

use App\Events\PostCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Mail\PostCreatedMailable;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostApiController extends Controller
{    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());

        PostCreatedEvent::dispatch($post);
        
        return new PostResource($post);
    }
}
