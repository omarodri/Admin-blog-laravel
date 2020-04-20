@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Articles
                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
                </div>

                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th colspan="2">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td scope="row">{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input  type="submit"
                                                        value="Delete"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure yout want to delete dis article?')">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
