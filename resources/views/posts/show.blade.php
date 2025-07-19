@extends('layout.main')

@section('content')
    <div class="container my-5 d-flex justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Title -->
            <div class="text-center mb-4">
                <h1 class="fw-bold display-5">{{ $post->title }}</h1>
            </div>

            <!-- Featured Image -->
            <div class=" text-center mb-4">
                <img src="{{ asset('storage/' . $post->featured_image) }}" class="text-center rounded shadow-sm" alt="Featured Image">
            </div>

            <!-- EditorJS JSON -->
            <script type="application/json" id="editorjs-content-json">
                {!! $post->content !!}
            </script>

            <!-- Rendered Content -->
            <div id="editorjs-render" class="bg-white p-4 rounded shadow-sm blog-body"></div>
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/editorjs-render.js'])
    @endpush
@endsection
