@extends('layouts.app')

@section('content')
<div id="website">

    <div class="px-4 py-5 mt-5 text-center">
        <a class="d-block mb-5 text-white" href="{{route('websites')}}">{{ __('Back to all websites') }}</a>

        <h5 class="mb-3"><span class="badge bg-secondary">{{ $website->type }}</span></h5>
        <h1 class="display-5 fw-bold text-white">{{ $website->name }}</h1>

        <div class="col-lg-6 mx-auto text-white">
            <p class="lead mb-4">URL: <a href="{{ $website->url }}">{{ $website->url }}</a></p>
        </div>

        <div class="col-lg-6 mx-auto">
            <h3 class="mt-5 mb-3 text-white">{{ __('Subscribe to posts from this website') }}</h3>
            <form id="subscribe-form" action="{{ route('websites.subscribe', ['website' => $website]) }}" method="POST" class="row g-0 justify-content-center">

                @csrf

                <div class="form-input col-md-9 my-2">
                    <input name="email" id="email" type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{__('Enter email')}}">
                    @foreach ($errors->get('email') as $message)
                    <div id="emailFeedback" class="invalid-feedback">{{ $message }}</div>
                    @endforeach
                </div>

                <div class="form-button col-md-3 my-2">
                    <button type="submit" class="btn btn-primary btn-lg px-4 gap-3">
                        {{ __('Subscribe') }}
                    </button>
                </div>

            </form>

            @if(Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
            @endif
        </div>


        <div class="col-md-6 mx-auto">
            <h3 class="mt-5 mb-3 text-white">{{ __('Posts') }}</h3>
            @if ($posts->isEmpty())
            <div class="alert alert-info">{{ __("There are no posts to display") }}</div>
            @else
            <div class="accordion accordion-flush text-start" id="accordionFlushExample">
                @foreach ($posts as $post)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading-{{$post->id}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{$post->id}}" aria-expanded="false" aria-controls="flush-collapse-{{$post->id}}">
                            {{ $post->title }}
                        </button>
                    </h2>
                    <div id="flush-collapse-{{$post->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{$post->id}}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <p>{{ $post->content }}</p>
                            <small class="text-muted">{{ __('Posted') }}: {{ $post->created_at }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-auto">
                {{ $posts->links() }}
            </div>
        </div>

    </div>

</div>
@endsection