@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="w-100">
            {{-- <div class="card"> --}}
                <div class="h4 font-weight-bold">Últimos documentos generados</div>

                {{-- <div class="card-body"> --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table mt-5">
                        <thead class="h5 bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Documento</th>
                                {{--  <th>Creador</th>  --}}
                                <th>Fecha Creación</th>
                                {{--  <th>Action</th>  --}}
                            </tr> 
                        </thead>   
                        <tbody class="h6">
                            <?php $no=1; ?>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $post->TipoDocumento }}</td>
                                {{--  <td>{{ $post->created_by }}</td>  --}}
                                <td>{{ $post->FechaHora_creación}}</td>
                                {{--  <td>
                                    <a href="{{route('post.form',$post->_id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{route('post.delete',$post->_id)}}" onclick="return confirm('Are you sure want to delete this post?')" class="btn btn-danger btn-sm">Delete</a>
                                </td>  --}}
                            </tr> 
                            <?php $no++; ?>
                            @endforeach
                        </tbody>   
                    </table>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection
