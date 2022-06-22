@component('mail::message')
# New Website Post
 
A new post has been posted on a website you are subscribed to:
 
@component('mail::panel')
Website: {{ $post->website->name }}

Post Title: {{ $post->title }}

Post Content: {{ $post->content }}

@component('mail::button', ['url' => route('websites.show', ['website' => $post->website])])
Visit Site
@endcomponent
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent