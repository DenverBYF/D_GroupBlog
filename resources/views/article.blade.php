<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('editormd/css/editormd.preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('editormd/css/editormd.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <style>
        body {
            background: url("../img/back.png") repeat;
        }
        .post_a{
            float:left;height:10px;
        }
        .nav_a {
            color: #FFFFFF;
        }
    </style>
    <title>{{ $post->title }}</title>
</head>
<body>
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <ul class="nav nav-pills">
                <li><a class="nav_a" style="font-size: 18px" href="{{route('welcome')."?page=1"}}">{{ $name }}</a></li>
                @foreach($tag as $each_tag)
                    <li><a class="nav_a" style="font-size: 18px" href="{{ route('welcome')."/?tag_id=$each_tag->id" }}">{{ $each_tag->name }}</a></li>
                    @if($loop->index == 4)
                        @break
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8" style="margin: 40px 0px 0px 0px">
                <div class="markdown-body editormd-html-preview">
                    <h1>{{ $post->title }}</h1>
                    <p>
                        <span>
                            <i class="glyphicon glyphicon-calendar"></i>&nbsp;{{ $post->created_at }}&nbsp;&nbsp;
                            <i class="glyphicon glyphicon-tag"></i>&nbsp;{{ $post->tag->name }}&nbsp;&nbsp;
                            <i class="glyphicon glyphicon-eye-open"></i>&nbsp;{{ $post->view }}
                        </span>
                    </p>
                    {!! $post->html_content !!}
                </div>
        </div>
        <div id="user_info"  class="col-sm-4 col-md-4 col-lg-4" style="margin-top: 40px">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h5>文章作者</h5>
                    </div>
                    <div class="panel-body text-center">
                        <img class="img-circle" style="width: 55px;height: 55px" src="{{ empty($post->user->url)?asset("../storage/app/public/user/default.jpg"):asset("../storage/app/public/user/")."/".$post->user->url }}">
                        <p style="color: #0a001f;font-size: 15px">{{ $post->user->name }}</p>
                        <p style="color: #0a001f;font-size: 15px">{{ empty($post->user->sign)?"":$post->user->sign }}</p>
                        <p>
                            <span><a href="{{ empty($post->user->github)?"":$post->user->github }}" target="_blank"><i class="fa fa-fw fa-github"></i>Github</a></span>&nbsp;&nbsp;
                            <span><a href="{{ empty($post->user->website)?"":$post->user->website  }}" target="_blank"><i class="fa fa-fw fa-home"></i>Website</a></span>
                        </p>
                    </div>
                </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4" style="margin-top: 10px">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h5>作者文章</h5>
                    </div>
                    <ul>
                        @foreach($post->user->posts as $each_post)
                            <li>
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <a class="post_a" href="{{ route('article',['id'=>$each_post->id]) }}" style="font-size: 10px;" data-toggle="tooltip" title="{{ $each_post->title }}">
                                        {{ mb_substr($each_post->title,0,22,'utf-8')."..." }}
                                    </a>&nbsp;&nbsp;
                                </div>
                                <span class="badge">{{ $each_post->view }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8" style="margin: 20px 0px 0px 0px">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">评论区( 现有评论{{ $post->comment->count() }} )</h3>
                </div>
                <div class="panel-body">
                @foreach($post->comment as $each_comment)
                        <div class="media" style="background-color: #FFFFFF">
                            <a class="media-left" href="#">
                                <img class="media-object img-circle" style="width: 100px;height: 100px" src="{{ empty($each_comment->user_id)?asset('../storage/app/public/user/default.jpg'):asset('../storage/app/public/user')."/".$each_comment->user->url }}"
                                        alt="媒体对象">
                            </a>
                            <div class="media-body " style="background-color: #FFFFFF">
                                <h4 class="media-heading">{{ $each_comment->name }}</h4>
                                <div class="markdown-body editormd-html-preview">
                                    {!! $each_comment->content !!}
                                </div>
                            </div>
                        </div>
                        <HR>
                @endforeach
                </div>
                <div class="panel-footer">
                    <form class="form-horizontal" method="post" action="{{ route('comment.store') }}"  id="post-form" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{ $post->id }}">
                        @guest
                            <div class="col-md-6 col-sm-6 form-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="输入一个昵称" >
                            </div>
                            <div class="col-md-6 col-sm-6 form-group">
                                <input type="text" class="form-control" name="email" id="email" placeholder="输入你的邮箱">
                            </div>
                        @endguest
                        <label for="editormd">评论(Markdown格式)</label>
                        <div class="form-group" id="editormd">
                            <textarea class="editormd-markdown-textarea" style="display:none;" id="content" name="content"></textarea>
                            <textarea style="display:none;"  name="html_content" id="html_content"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn-success btn-lg" type="button" onclick="send()">提交</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('editormd/editormd.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootbox.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        editor = editormd("editormd", {
            path:"{{ asset('editormd/lib') }}"+"/",
            height: 250,
            syncScrolling: "single",
            toolbarAutoFixed: false,
            saveHTMLToTextarea: false,
            toolbar  : false,
        });
    });
    function send() {
        var html_content = editor.getPreviewedHTML();
        $("#html_content").val(html_content);
        $.ajax({
            url:"{{ route('comment.store') }}",
            data:$("#post-form").serialize(),
            type:"POST",
            success:function (data) {
                bootbox.alert("评论成功",function () {
                   window.location.reload();
                })
            },
            error:function (e) {
                bootbox.alert("评论失败",function () {
                    console.log(e);
                })
            }
        })
    }
</script>
</html>