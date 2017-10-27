@extends('adminlte::page')

@section('title','文章管理')

@section('content_header')
    <h1>文章列表</h1>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-11 col-lg-11 col-sm-11">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>文章题目</th>
                    @role('admin')
                        <th>文章作者</th>
                    @else
                        <th>发布时间</th>
                    @endrole
                    <th>文章标签</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="article-list">
                @foreach($post as $each_post)
                    <tr id="{{ $each_post->id }}">
                        <th><a href="{{ route("article",['id'=>$each_post->id]) }}">{{ $each_post->title }}</a></th>
                        @role('admin')
                            <th><a href="{{ route("users.show",['id'=>$each_post->user->id]) }}">{{ $each_post->user->name }}</a></th>
                            <th><a href="{{ route("tags.show",['id'=>$each_post->tag->id]) }}">{{ $each_post->tag->name }}</a></th>
                        @else
                            <th>{{ $each_post->created_at }}</th>
                            <th>{{ $each_post->tag->name }}</th>
                        @endrole

                        <th>
                            <button id="{{ $each_post->id }}" class="btn-sm btn-danger" type="button" onclick="remove(this.id)">删除</button>
                            @role('admin')

                            @else
                                <button id="{{ $each_post->id }}" class="btn-sm btn-success" type="button" onclick="edit(this.id)">编辑</button>
                            @endrole
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $post->links() }}
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        function remove(id)
        {
            bootbox.confirm("你确定要删除这篇文章吗?",function (result) {
                if(result){
                    $.ajax({
                        url:"{{route('article.index')}}"+"/"+id,
                        type:"DELETE",
                        success:function (data) {
                            bootbox.alert("删除成功",function(){
                                window.location.reload();
                            });
                        },
                        error:function (e) {
                            console.log(e);
                        }
                    });
                }
            });
        }
        function edit (id) {
            window.location.href="article/"+id+"/edit";
        }
    </script>