@extends('adminlte::page')

@section('title','标签管理')

@section('content_header')
    <h1>标签列表</h1>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-11 col-lg-11 col-sm-11">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>标签名称</th>
                    <th>文章数</th>
                </tr>
                </thead>
                <tbody id="tag_list">
                    @foreach($tag as $each_tag)
                        <tr id="{{ $each_tag->id }}">
                            <th><a href="{{ route("tags.show",['id'=>$each_tag->id]) }}">{{ $each_tag->name }}</a></th>
                            <th>{{ $each_tag->posts->count() }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $tag->links() }}
    </div>

@endsection

