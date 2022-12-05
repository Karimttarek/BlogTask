@extends('layouts.app')
@section('content')
    @if (session('status'))
    <div class="container">
        <div class="form-group col-12 p-1" style="background: #dff0d8">
            <p>{{ session('status') }}</p>
        </div>
    </div>
    @endif
<main class="container">
    @foreach ($posts as $post)
    <div class="row featurette">
        <div class="col-md-7">
          <h4 class="featurette-heading">{{$post->title}}</h4>
          <p class="lead">{{$post->content}}</p>
          <span class="text-muted">{{$post->author}} - since {{$post->created_at}}</span>
          <hr>
          @foreach ($post->comment as $comments)
            <span class="text-muted">{{$comments->comment}}<hr>
          @endforeach
            <form class="input-group" action="{{route('comment.create')}}" method="POST">
                @csrf
                <input name="post_id" type="text" value="{{$post->id}}" hidden>
                <input class="input-group-text" type="text" name="comment">
                @if (Auth::check())
                    <button type="submit" class="btn btn-info">Comment</button>
                @else
                    <a class="btn btn-info" href="{{route('loginView')}}">Login to comment</a>
                @endif
            </form>
        </div>
        <div class="col-md-5">
          <img src="{{URL::asset($post->image_url)}}" alt="">
        </div>
      </div>
      <hr class="featurette-divider">
    @endforeach

    @if ($posts->count() <= 0)
        <p>No posts found.</p>
    @endif

  </main>
@endsection
