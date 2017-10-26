@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>{{ $user }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <a href="{{ route('post.index') }}"><span class="info-box-icon bg-red-gradient"><i class="fa fa-file"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">现有文章</span>
                    <span class="info-box-number">{{ $post_num }}篇</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="info-box">
                <a href="{{ route('tags.index') }}"><span class="info-box-icon bg-blue-gradient"><li class="fa fa-tags"></li></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">现有标签</span>
                    <span class="info-box-number">{{ $tag_num }}个</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="info-box">
                <a href="{{ route('users.index') }}"><span class="info-box-icon bg-yellow-gradient"><li class="fa fa-users"></li></span></a>
                <div class="info-box-content">
                    <span class="in-box-text">团队人数</span>
                    <span class="info-box-number">{{ $user_num }}人</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12"><br><br></div>
        <div class="col-sm-8 col-md-8 col-lg-8">
            <h3><label for="hot_post">热门文章</label></h3>
            <table class="table table-striped" id="hot_post">
                <thead>
                    <tr>
                        <th>文章</th>
                        <th>作者</th>
                        <th>浏览量</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $each_post)
                        <tr>
                            <th><a href="{{ route('article.show',['id'=>$each_post->id]) }}">{{ $each_post->title }}</a></th>
                            <th><a href="{{ route('users.show',['id'=>$each_post->user->id]) }}">{{ $each_post->user->name }}</a></th>
                            <th><span class="badge">{{ $each_post->view }}</span></th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@stop