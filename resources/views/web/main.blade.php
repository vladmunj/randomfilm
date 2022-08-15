@extends('web.layouts.layout')

@section('content')
<div class="uk-container-small uk-position-center">
    <div class="movie-card">
        <div class="movie-header" style="background: url('../posters/{{ $movie->poster }}')">
            <div class="header-icon-container uk-position-center">
                
            </div>
        </div><!--movie-header-->
        <div class="movie-content">
            <div class="movie-content-header">
                <h3 class="movie-title">{{ $movie->name }}</h3>
            </div>
            <div class="movie-content-header">
                <a href="{{ $movie->video_link }}" class="uk-icon-link play-button" uk-icon="play-circle" ratio="3"></a>
                <a href="#" class="uk-icon-link refresh-page-button" uk-icon="refresh" ratio="2"></a>
            </div>
        </div><!--movie-content-->
    </div><!--movie-card-->
</div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script>
        $(function(){
            $(document).on('click','.refresh-page-button',function(){
                window.location.reload();
                return false;
            });
        });
    </script>
@endsection