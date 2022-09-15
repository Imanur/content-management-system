@extends('portal.app')
@section('sc-css')
<link href="{{ url('assets/03-About-me/css/styles.css') }}" rel="stylesheet">
<link href="{{ url('assets/03-About-me/css/responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="recomend-area">
    <h4 class="title"><b class="light-color">Info</b></h4>
    <div class="row">

        @foreach ($data['infos'] as $infos)
        <div class="col-md-6">

            <div class="recomend">
                
                    <h5 class="title"><a href="{{ url('info-detail/'.$infos->id) }}"><b class="light-color">{{ substr($infos->judul_info, 0, 30).(strlen($infos->judul_info) > 30 ? "..." : "") }}</b></a></h5>
                    <h5 class="title"><a href="{{ url('info-detail/'.$infos->id) }}"><b class="light-color">{{ substr($infos->isi_info, 0, 30).(strlen($infos->isi_info) > 30 ? "..." : "") }}</b></a></h5>
                    <h6 class="date"><em>{{date('D, M Y', strtotime($infos->created_at))}}</em></h6>
                    {!! substr($infos->content, 0, 30).(strlen($infos->content) > 30 ? "..." : "") !!}
             
            </div><!-- recomend -->

        </div><!-- col-md-6 -->
        @endforeach

    </div><!-- row -->
</div><!-- recomend-area -->
@endsection
