@extends('layouts.app')

@section('content')
<div id="dashboard">

    <div class="px-4 py-5 mt-5 text-center text-white">
        <h1 class="display-5 fw-bold">{{ __('Website Subscriber') }}</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">{{ __('Search our list of websites and subscribe to the latest posts.') }}</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <form id="filters-form" action="{{ route('websites') }}" method="GET" class="row justify-content-center">

                    <div class="form-input col-md-10 my-2">
                        <input name="search" id="search" type="text" class="form-control form-control-lg @error('search') is-invalid @enderror" value="{{ old('search', request()->input('search')) }}" placeholder="{{__('Search for a website')}}">
                        @foreach ($errors->get('search') as $message)
                        <div id="searchFeedback" class="invalid-feedback">{{ $message }}</div>
                        @endforeach
                    </div>

                    <div class="form-input col-md-10 my-2">
                        <select name="type" id="type" class="form-select form-select-lg @error('type') is-invalid @enderror">
                            <option value="">{{ __('All types') }}</option>
                            @foreach ($types as $type)
                            <option value="{{ $type }}" @if (old('type', request()->input('type')) == $type) selected @endif>{{ $type }}</option>
                            @endforeach
                        </select>
                        @foreach ($errors->get('type') as $message)
                        <div id="typeFeedback" class="invalid-feedback">{{ $message }}</div>
                        @endforeach
                    </div>

                    <div class="form-button my-2">
                        <button type="submit" class="btn btn-primary btn-lg px-4 gap-3">
                            {{ __('Search') }}
                        </button>
                        @if (request()->input('search') || request()->input('type'))
                        <a href="{{ route('websites') }}" class="btn btn-outline-primary btn-lg px-4 ms-1">{{ __('Clear search') }}</a>
                        @endif
                    </div>

                </form>
            </div>

        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($websites->isEmpty())
            <div class="alert alert-info">{{ __("There are no websites to display") }}</div>
            @else
            <div id="websites-list">
                @include('websites.list')
            </div>
            @endif
        </div>
    </div>

</div>
@endsection