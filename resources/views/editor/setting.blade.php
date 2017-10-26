@extends('adminlte::page')

@section('title', '个人设置')


@section('content_header')
    <h1>个人设置</h1>
@stop

@section('content')
    <div class="conatiner">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" role="form" method="post" action="{{ route('editor_setting') }}" id="editor_setting" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                    <label for="name">昵称</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name}}">
                </div>
                <div class="form-group col-sm-6 col-lg-6 col-md-6">
                    <label for="uploadfile">头像</label>
                    <input type="file" name="uploadfile" id="uploadfile" multiple class="file-loading form-control" />
                </div>
                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                    <label for="website">个人主页</label>
                    <input type="text" class="form-control" name="website" id="website" value="{{ empty($user->website)?"":$user->website }}">
                </div>
                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                    <label for="github">Github</label>
                    <input type="text" class="form-control" name="github" id="github" value="{{ empty($user->github)?"":$user->github }}">
                </div>
                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                    <label for="sing">个性签名</label>
                    <input type="text" class="form-control" name="sign" id="sign" value="{{ empty($user->sign)?"":$user->sign }}">
                </div>
                <div class="form-group col-sm-8 col-md-8 col-lg-8">
                    <label for="key_word">关注方向(空格分割)</label>
                    <input type="text" class="form-control" name="key_word" id="key_word" value="{{ empty($user->key_word)?"":$user->key_word }}">
                </div>
                <div class="form-group col-sm-8 col-md-8 col-lg-8">
                    <label for="desc">个人介绍</label>
                    <textarea name="desc" id="desc" class="form-control" rows="6">{{ empty($user->desc)?"":$user->desc }}</textarea>
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
            showPreview : false, //是否显示预览
            showCaption: true, //是否显示标题
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
            $("#editor_setting").ajaxSubmit(option)
        }
        $("#editor_setting").bootstrapValidator({
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
                            message:'昵称不能为空'
                        }
                    }
                }
            }
        })
    </script>
@endsection