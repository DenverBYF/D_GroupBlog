@extends('adminlte::page')

@section('header','User')

@section('content_header')
    <h1>{{ $name }}</h1>
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-11 col-md-11 col-lg-11">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>文章题目</th>
                        <th>文章标签</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $each_post)
                        <tr>
                            <th><a href="{{ route("article.show",['id'=>$each_post->id]) }}">{{ $each_post->title }}</a></th>
                            <th><a href="{{ route("tags.show",['id'=>$each_post->tag->id]) }}">{{ $each_post->tag->name }}</a></th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $posts->links() }}
    </div>
@endsection