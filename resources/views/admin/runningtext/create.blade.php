@extends('admin.app')
@section('content')
    <h3>Create Running Text</h3>
    <hr>
    <div class="col-lg-6">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ url('admin/runningtext/create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control">
            <label for="link">Link</label>
            <input type="text" name="link" class="form-control">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="1">Publish</option>
                <option value="0">Tidak Publish</option>
            </select>
            <br>
            <input type="submit" name="submit" class="btn btn-md btn-primary" value="Tambah Data">
            <a href="{{ url('admin/runningtext') }}" class="btn btn-md btn-warning"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
        </form>
    </div>
@endsection
