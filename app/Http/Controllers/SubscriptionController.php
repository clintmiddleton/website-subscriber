<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    
    /**
     * subscribe
     *
     * @param  mixed $request
     * @param  mixed $website
     * @return void
     */
    public function subscribe(SubscriptionRequest $request, Website $website)
    {
        $subscription = $website->subscriptions()->updateOrCreate(
            $request->validated(),
            $request->validated()
        );

        return redirect(route('websites.show', ['website' => $website]))
            ->with('success', __('You have been subscribed successfully'));
    }
}
