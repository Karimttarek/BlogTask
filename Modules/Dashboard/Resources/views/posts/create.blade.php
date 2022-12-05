@extends('dashboard::layouts.app')
@section('content')
@if (session('status'))
        <div class="form-group col-12 p-1" style="background: #dff0d8">
            <p>{{ session('status') }}</p>
        </div>
    @endif
    <div class="row justify-content-center p-t-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Create New Post</div>

                <div class="card-body">
                    <form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
                        @csrf

                          <!-- INSTRUCTOR -->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="title">*Title</label>
                              <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
                                 @error('title')
                                <div>
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                          </div>

                          <!-- INSTRUCTOR =>  TITLE && DEPARTMENT -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="author">Author</label>
                              <input type="text" class="form-control @error('author') is-invalid @enderror" name="author">
                                 @error('author')
                                <div>
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="content">Content</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="10"></textarea>
                                   @error('content')
                                  <div>
                                      <span class="text-danger">{{$message}}</span>
                                  </div>
                                  @enderror
                              </div>
                              <div class="form-group col-md-4">
                                <label for="image" class="col-form-label text-md-right">Image</label>
                                <div class="col-md-12">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                </div>
                                @error('image')
                                <div>
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                              </div>
                          </div>

                        <br>

                        <div class="form-group  mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-outline-success">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
