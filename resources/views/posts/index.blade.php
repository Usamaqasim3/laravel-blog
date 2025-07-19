@extends('layout.main')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">All Blog Posts</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-success">+ Create New Post</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($posts->count())
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">View</a>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center">No blog posts found.</p>
        @endif
    </div>
@endsection
