@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Articles</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form   action="{{ route('posts.update', $post) }}"
                            method="post"
                            enctype="multipart/form-data">

                    <div class="form-group">
                      <label for="title">Title *</label>
                      <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required class="form-control" placeholder="Enter a Title" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" name="image" >
                    </div>

                    <div class="form-group">
                        <label for="body">Content *</label>
                        <textarea name="body" id="body" rows="6" required class="form-control">{{ old('body', $post->body) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="iframe">Embebed Content</label>
                        <textarea name="iframe" id="iframe" class="form-control">{{ old('iframe', $post->iframe) }}</textarea>
                    </div>

                    <div class="form-group">
                        @csrf
                        @method('PUT')
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
