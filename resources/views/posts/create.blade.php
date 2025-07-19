@extends('layout.main')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Create New Blog Post</h2>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="post-form">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Featured Image</label>
                <input type="file" name="featured_image" class="form-control" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <div id="editorjs" class="border rounded p-3" style="background-color: #fff; min-height: 300px;"></div>
                <input type="hidden" name="content" id="editorContent" />
            </div>

            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
    </div>

    <!-- Include Editor.js and Tools -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>

    <script>
        const editor = new EditorJS({
            holder: 'editorjs',
            tools: {
                header: {
                    class: Header,
                    inlineToolbar: true
                },
                paragraph: {
                    class: Paragraph,
                    inlineToolbar: true,
                    config: {
                        preserveBlank: true
                    }
                },
                image: {
                    class: ImageTool,
                    config: {
                        field: 'image',
                        endpoints: {
                            byFile: '{{ route("editorjs.imageUpload") }}',
                        },
                        additionalRequestHeaders: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                }
            },
            placeholder: 'Write your amazing post...',
        });

        document.getElementById('post-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            try {
                const output = await editor.save();

                // Validation: if content is empty
                if (!output.blocks || output.blocks.length === 0) {
                    alert("Content cannot be empty.");
                    return;
                }

                document.getElementById('editorContent').value = JSON.stringify(output);
                this.submit();
            } catch (err) {
                console.error("Editor.js save error:", err);
                alert("Something went wrong with the editor. Please check your content.");
            }
        });
    </script>
@endsection
