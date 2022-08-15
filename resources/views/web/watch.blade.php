@extends('web.layouts.layout')

@section('content')
    <iframe src="{{ $movie->video_link }}" class="video-player"></iframe>
    <div style="text-align:center;">
        <a href="/" class="uk-icon-link main-page-button" uk-icon="home" ratio="2"></a>
    </div>
@endsection