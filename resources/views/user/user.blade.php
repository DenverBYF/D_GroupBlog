@extends('adminlte::page')

@section('header','人员管理')

@section('content_header')
    <div class="col-sm-10 col-lg-10 col-md-10">
    </div>
    <div class="col-sm-2 col-lg-2 col-md-2">
        <button type="button" class="btn btn-success" onclick="create_invite_code()">生成邀请码</button>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-11 col-lg-11 col-md-11">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>昵称</th>
                        <th>邮箱</th>
                        <th>角色</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="user_list">
                    @foreach($user as $each_user)
                        <tr id="{{ $each_user->id }}">
                            <th><a href="{{ route("users.show",['id'=>$each_user->id]) }}">{{ $each_user->name }}</a></th>
                            <th>{{ $each_user->email }}</th>
                            @if($each_user->getRoleNames()[0]=='admin')
                                <th><p class="text-danger">{{ $each_user->getRoleNames()[0] }}</p></th>
                            @elseif($each_user->getRoleNames()[0]=='editor')
                                <th>{{ $each_user->getRoleNames()[0] }}</th>
                            @endif
                            <th><button type="button" class="btn btn-danger" id="{{ $each_user->id }}" onclick="remove(this.id)">删除该用户</button> </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $user->links() }}
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function create_invite_code()
        {
            $.ajax({
                url:"{{ route('code') }}",
                type:"GET",
                success:function (data) {
                    bootbox.alert("创建成功:<br>"+data);
                },
                error:function (e) {
                    bootbox.alert("创建失败");
                }
            })
        }
        function remove(id)
        {
            bootbox.confirm("你确定要删除这个用户及其所有文章吗?",function (result) {
                if(result){
                    $.ajax({
                        url:"users/"+id,
                        type:"DELETE",
                        success:function (data) {
                            bootbox.alert("删除成功",function(){
                                window.location.reload();
                            });
                        },
                        error:function (e) {
                            bootbox.alert("删除失败");
                            console.log(e);
                        }
                    });
                }
            });
        }
    </script>