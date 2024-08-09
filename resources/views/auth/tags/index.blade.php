@extends('layouts.auth')

@Section('title', 'tags')

@section('style')
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
    <div class="content-wrappercategory">
        <div class="content">
            <!-- Masked Input -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Tags</h2>
                    <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-input-musk" role="button"
                        aria-expanded="false" aria-controls="collapse-input-musk"> </a>
                </div>
                <div class="card-body">
                    @if (count($tags) > 0)
                        <table class="table" id="posts">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tag Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->id }}</td>
                                        <td>{{ $tag->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h2 class="text-center text-danger">No Category Found</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('script')
    <script src="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#posts').DataTable({
                'bLengthChange': false,
            });
        });
    </script>

@endsection --}}
