@extends('layouts.auth')

@section('title', 'edit post | Admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/multipal-dropdown.css') }}">
@endsection

@section('content')

    <div class="content-wrapperedit">
        <div class="content">
            <!-- Masked Input -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>edit Post</h2>
                    <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-input-musk" role="button"
                        aria-expanded="false" aria-controls="collapse-input-musk"> </a>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif

                    <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ old('title', $post->title) }}"
                                class="form-control" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3" col="30" style="resize:none;"
                                placeholder="Description">{{ old('title', $post->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="" disabled selected>Cholse Options</option>
                                <option @selected(old('status', $post->status) == 1) value="1">Publish</option>
                                <option @selected(old('status', $post->status) == 0) value="0">Draf</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <option value="" disabled selected>Choose Options</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option @selected(old('category', $post->category) == $category->id) value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <select name="tags[]" class="form-control selectpicker" multiple data-live-search="true">
                                <option value="" disabled selected>Choose Options</option>
                                  @if(count($tags) > 0)
                                        @foreach ($tags as $tag)
                                            <option 
                                                value="{{ $tag->id }}" 
                                                @if($postTags->pluck('tag_id')->contains($tag->id)) selected @endif>{{ $tag->name }}
                                            </option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                         <div class="form-group mb-4">
                            <label>Image</label>
                            <input type="file" name="file" value="{{ old('file') }}" class="form-control"
                                placeholder="file">
                        </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/auth/js/multi-dropdown.js') }}"></script>
    <script>
        $(document).ready(function() {
            console.log('testing');
        })
    </script>
@endsection
