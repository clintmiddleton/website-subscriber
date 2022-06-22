<div class="row justify-content-center">
    @foreach ($websites as $website)
    <div class="col-xl-6 my-2">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title fw-bold">
                    <a href="{{ route('websites.show', ['website' => $website]) }}">{{ $website->name }}</a>
                    <a href="{{ route('websites.show', ['website' => $website]) }}" class="btn btn-sm btn-primary float-end">{{ __('Subscribe') }}</a>
                </h5>
                <p class="my-1">
                    <span class="badge badge-lg bg-secondary">{{ $website->type }}</span>
                </p>
                <p class="card-text my-0">
                    Number of posts: {{ $website->posts_count }}
                </p>
                <p class="card-text my-0">
                    Number of subscribers: {{ $website->subscriptions_count }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row justify-content-center mt-4">
    <div class="col-auto">
        {{ $websites->links() }}
    </div>
</div>