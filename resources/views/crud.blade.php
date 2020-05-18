@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CRUD</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr> 
                        </thead>   
                        <tbody>
                            <?php $no=1; ?>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->created_by }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    <a href="{{route('post.form',$post->_id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{route('post.delete',$post->_id)}}" onclick="return confirm('Are you sure want to delete this post?')" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr> 
                            <?php $no++; ?>
                            @endforeach
                        </tbody>   
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
