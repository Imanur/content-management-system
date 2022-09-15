@extends('admin.app')
@section('content')
<h3>Admin</h3>
<hr>
@if (Session::has('status'))
<div class="alert alert-warning" role="alert">
    {{Session::get('status')}}
</div>
@endif
<table class="table table-bordered">
    <thead class="bg-primary text-light">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>

    @foreach($data as $d)
    <tr>
        <td>{{$d->name}}</td>
        <td>{{$d->email}}</td>
        <td><img width="100px" src="{{ url($d->image) }}"></td>
        <td>
            <a href="{{ url('admin/profile/edit/'.$d->id) }}" class="btn btn-primary btn-md"><i class="
            far fa-edit"></i> Edit</a>
            <a href="{{url('admin/profile/delete/'.$d->id)}}" class="btn btn-danger btn-md"><i class="
            fas fa-trash"></i> Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection