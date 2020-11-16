@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> 
                   {{ Session('message') }}
                </div>
            @endif

            @if(Session::has('delete-message'))
                <div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> 
                   {{ Session('delete-message') }}
                </div>
            @endif
        </div>
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Category - List
                <a href="{{ route('categories.create')}}" class="btn btn-sm btn-primary float-right">Add New</a>

                </div>

                <div class="card-body">
                  <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th scope="col" width="60">#</th>
                            <th scope="col" >Name</th>
                            <th scope="col" width="200">Created By</th>
                            <th scope="col" width="129">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category )
                            <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->user->name}}</td>
                            <td>
                            <a href="{{ route('categories.edit', $category->id)}}"
                                class="btn btn-sm btn-primary">Edit</a>
                                {!!Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'deleted',
                                'style' => 'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger'])!!}
                                {!! Form::close()!!}

                            {{-- <a href=""><form action="{{ route('categories.destroy', $category->id)}}" method="POST" style="display: hidden">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                            </form></a> --}}
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>

           

           
        </div>
    </div>
</div>
@endsection
