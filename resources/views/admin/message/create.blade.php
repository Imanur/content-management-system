@extends('admin.app')
@section('content')
<h3>Create Message</h3>
<hr>
<div class="col-lg-6">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{url('admin/message/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control">
        <label for="subject">Subject</label>
        <input type="text" name="subject" class="form-control">
        <label for="message">Message</label>
        <textarea class="form-control" name="message" id="message" cols="50" rows="10"></textarea><br>
        <input type="submit" name="submit" class="btn btn-md btn-primary" value="Tambah Data">
        <a href="{{ url('admin/message') }}" class="btn btn-md btn-warning"><i class="fas 
        fa-chevron-circle-left"></i> Kembali</a>
    </form>
</div>
@endsection
@section('js')
<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>
<script>
    var message = document.getElementById("message");
    CKEDITOR.replace(message, {
        language: 'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
</script>
@endsection