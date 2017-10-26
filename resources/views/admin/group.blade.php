@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/fileinput.min.css ') }}">

@section('title', 'Settiing')

@section('content_header')
    <h1>团队设置</h1>
@stop

@section('content')
    <div class="container">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <form action="{{ route('group.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id="group_form">
                {{ csrf_field() }}
                <div class="form-group col-sm-8 col-md-8 col-lg-8">
                    <label for="title">团队名称</label>
                    <input class="form-control" name="name" id="name"  value="{{ $group->name }}">
                </div>
                <div class="form-group col-sm-8 col-lg-8 col-md-8">
                    <label for="uploadfile">团队头像</label>
                    <input type="file" name="uploadfile" id="uploadfile" multiple class="file-loading form-control" />
                </div>
                <div class="form-group col-sm-8 col-lg-8 col-md-8">
                    <label for="email">团队邮箱</label>
                    <input type="text" name="email" id="email" placeholder="请输入团队邮箱" class="form-control" value="{{ $group->email }}">
                </div>
                <div class="form-group col-sm-8 col-lg-8 col-md-8">
                    <label for="desc">团队描述</label>
                    <textarea class="form-control" name="desc" id="desc" placeholder="团队描述" rows="8">{{ empty($group->desc)?"":$group->desc }}</textarea>
                </div>
                <div class="form-group col-sm-8 col-md-8 col-lg-8">
                    <div class="col-sm-2 col-lg-2 col-md-2">
                        <button type="button" class="btn-md btn-primary form-control" onclick="send()">提交</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/fileinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/zh.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript">
        $("#uploadfile").fileinput({
            language: 'zh', //设置语言
            uploadUrl: '', //上传的地址
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],//接收的文件后缀
            //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
            uploadAsync: false, //默认异步上传
            showUpload: false, //是否显示上传按钮
            showRemove : true, //显示移除按钮
            showPreview : true, //是否显示预览
            showCaption: false, //是否显示标题
            browseClass: "btn btn-primary", //按钮样式
            dropZoneEnabled: false,//是否显示拖拽区域
            //minImageWidth: 50, //图片的最小宽度
            //minImageHeight: 50,//图片的最小高度
            //maxImageWidth: 1000,//图片的最大宽度
            //maxImageHeight: 1000,//图片的最大高度
            maxFileSize: 1024,//单位为kb，如果为0表示不限制文件大小
            //minFileCount: 0,
            maxFileCount: 1, //表示允许同时上传的最大文件个数
            //enctype: 'multipart/form-data',
            validateInitialCount:true,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            //msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
        });
        function send() {
            var option = {
                success:function (data) {
                    bootbox.alert("修改成功",function () {
                        window.location.reload();
                    });
                },
                error:function (e) {
                    bootbox.alert("修改失败");
                    console.log(e);
                }
            };
            $("#group_form").ajaxSubmit(option)
        }
        $("#group_form").bootstrapValidator({
            message: '这个值没有被验证',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields:{
                name:{
                    validators:{
                        notEmpty:{
                            message:'团队名不能为空'
                        }
                    }
                },
                email:{
                    validators:{
                        emailAddress:{
                            message:'请输入正确的邮箱地址'
                        }
                    }
                }
            }
        })
    </script>
@endsection()