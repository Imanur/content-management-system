@extends('admin.app')
@section('content')
    <h3>Message</h3>
    <hr>
    @if (Session::has('status'))
        <div class="alert alert-warning" role="alert">
                {{ Session::get('status') }}
        </div>
    @endif
    <a href="{{ url('admin/message/create')}}" class="btn btn-md btn-primary mb-3"><i class="fas fa-plus">
    </i> Tambah Data
</a>
    <table class="table table-bordered">
        <thead class="bg-primary text-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($data as $cat)
        <tr>
            <td>{{$cat->name}}</td>
            <td>{{$cat->email}}</td>
            <td>{{$cat->subject}}</td>
            <!-- <td>{{$cat->message}}</td> -->
            <td>{!! substr($cat->message,0,200)!!}</td>
            <td>

                <a href="{{ url('admin/message/delete/'.$cat->id) }}" class="btn btn-danger btn-md"><i class="fas fa-trash"></i> Delete</a>
            </td>
        </tr>
        @endforeach

    </table>
@endsection
