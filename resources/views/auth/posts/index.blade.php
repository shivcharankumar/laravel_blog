@extends('layouts.auth')

@Section('title', 'posts')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" />
    <style>
        #outer {
            text-align: center;
        }

        .inner {
            display: inline-block;
        }
    </style>

@endsection
@section('content')
    <div class="content-wrapperpost">
        <div class="content">
            <!-- Masked Input -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Create Post</h2>
                    <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-input-musk" role="button"
                        aria-expanded="false" aria-controls="collapse-input-musk"> </a>
                </div>

                @if (Session::has('alert-success'))
                    <div class="alert alert-success dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success</strong>{{ Session::get('alert-success') }}
                </div>
                @endif

                <div class="card-body">
                    @if (count($posts) > 0)
                        <table class="table" id="posts">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td><img src="{{ asset('storage/auth/posts/') . '/' . $post->gallery->image }}" alt="post image" style="width:80px;"></td>
                                        <td>{{Str::limit ($post->title,14) }}</td>
                                        <td>{{ Str::limit($post->description, 15) }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td class="text-{{ $post->status == 1 ? 'success' : 'danger' }}">{{ $post->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td id="outer">
                                            <a href="{{ route('posts.show',$post->id) }}"class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('posts.edit', $post->id) }}"class="btn btn-sm btn-info"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('posts.destroy',$post->id) }}" method="post" class="inner">
                                            @csrf
                                            @method('DELETE')
                                               <button type="submit"><a class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></a></button> 
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h2 class="text-center text-danger">No Post Found</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#posts').DataTable({
                'bLengthChange': false,
            });
        });
    </script>

@endsection
