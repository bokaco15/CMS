@extends('admin._layout._layout')
@section('title', "Edit: {$post->heading}")

@push('header_scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary col-12">
                        <div class="card-header">
                            <h3 class="card-title">Edit Post</h3>
                        </div>

                        <form action="{{route('admin.post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">

                                        {{-- HEADING --}}
                                        <div class="form-group">
                                            <label>Heading</label>
                                            <input
                                                type="text"
                                                name="heading"
                                                value="{{ old('heading', $post->heading) }}"
                                                class="form-control @error('heading') is-invalid @enderror"
                                                placeholder="Enter heading"
                                            >
                                            @error('heading')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- SLUG --}}
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input
                                                type="text"
                                                name="slug"
                                                readonly
                                                value="{{ old('slug', $post->slug) }}"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                placeholder="slug"
                                            >
                                            @error('slug')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- PREHEADING --}}
                                        <div class="form-group">
                                            <label>Preheading</label>
                                            <input
                                                type="text"
                                                name="preheading"
                                                value="{{ old('preheading', $post->preheading) }}"
                                                class="form-control @error('preheading') is-invalid @enderror"
                                                placeholder="Enter preheading"
                                            >
                                            @error('preheading')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- TEXT --}}
                                        <div class="form-group">
                                            <label>Text</label>
                                            <textarea
                                                name="text"
                                                id="editor"
                                                class="form-control @error('text') is-invalid @enderror"
                                                rows="10"
                                            >{!! old('text', $post->text) !!}</textarea>
                                            @error('text')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- CURRENT IMAGE --}}
                                        @if($post->image)
                                            <div class="form-group">
                                                <label>Current thumbnail</label>
                                                <div>
                                                    <img
                                                        src="{{ asset($post->image) }}"
                                                        alt="thumbnail"
                                                        style="max-width: 250px; border-radius: 8px; border: 1px solid #ddd;"
                                                    >
                                                </div>
                                            </div>
                                        @endif

                                        {{-- IMAGE --}}
                                        <div class="form-group">
                                            <label>Change thumbnail</label>
                                            <input
                                                type="file"
                                                name="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                            >
                                            @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- CATEGORY (SELECT2 SINGLE) --}}
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select
                                                name="category_id"
                                                id="category_id"
                                                class="form-control @error('category_id') is-invalid @enderror"
                                                style="width:100%"
                                            >
                                                <option value="">Select category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- TAGS (SELECT2 MULTIPLE) --}}
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <select
                                                name="tags[]"
                                                id="tags"
                                                class="form-control @error('tags') is-invalid @enderror"
                                                multiple
                                            >
                                                @foreach($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        {{ collect(old('tags', $post->tags->pluck('id')->toArray()))->contains($tag->id) ? 'selected' : '' }}>
                                                        {{ $tag->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('tags')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- IMPORTANT --}}
                                        <div class="form-group">
                                            <label>Important</label>
                                            <select name="important" class="form-control @error('important') is-invalid @enderror">
                                                <option value="0" {{ old('important', $post->important) == 0 ? 'selected' : '' }}>Not important</option>
                                                <option value="1" {{ old('important', $post->important) == 1 ? 'selected' : '' }}>Important</option>
                                            </select>

                                            @error('important')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- PUBLISHED --}}
                                        <div class="form-group">
                                            <label>Published</label>
                                            <select name="published" class="form-control @error('published') is-invalid @enderror">
                                                <option value="0" {{ old('published', $post->published) == 0 ? 'selected' : '' }}>Unpublished</option>
                                                <option value="1" {{ old('published', $post->published) == 1 ? 'selected' : '' }}>Published</option>
                                            </select>

                                            @error('published')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('admin.post.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function () {

            // slug auto from heading
            $("input[name='heading']").on('keyup', function () {
                let text = $(this).val().toLowerCase().trim();
                text = text.replace(/\s+/g,'-').replace(/[^a-z0-9\-]/g,'');
                $("input[name='slug']").val(text);
            });

            // select2
            $('#category_id').select2({
                width: '100%',
                placeholder: 'Select category'
            });

            $('#tags').select2({
                placeholder: 'Select tags',
                width: '100%'
            });

            // ckeditor
            CKEDITOR.replace('editor', {
                filebrowserUploadUrl: "{{ route('admin.post.uploadMedia', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });

            @if(session('success'))
            toastr.success("{!! session('success') !!}");
            @endif

            @if(session('error'))
            toastr.error("{!! session('error') !!}");
            @endif
        });
    </script>
@endpush
