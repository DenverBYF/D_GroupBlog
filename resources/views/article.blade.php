<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('editormd/css/editormd.preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <style>
        body {
            background: url("../img/back.png") repeat;
        }
        .post_a{
            float:left;height:10px;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="container">
            <div class="col-sm-8 col-md-8 col-lg-8" style="margin: 40px 0px">
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
            <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 40px">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h5>文章作者</h5>
                    </div>
                    <div class="panel-body text-center">
                        <img class="img-circle" style="width: 55px;height: 55px" src="{{ empty($post->user->url)?"../../storage/app/public/user/default.jpg":"../../storage/app/public/user/".$post->user->url }}">
                        <p style="color: #0a001f;font-size: 15px">{{ $post->user->name }}</p>
                        <p style="color: #0a001f;font-size: 15px">{{ empty($post->user->sign)?"":$post->user->sign }}</p>
                        <p>
                            <span><a href="{{ empty($post->user->github)?"":$post->user->github }}" target="_blank"><i class="fa fa-fw fa-github"></i>Github</a></span>&nbsp;&nbsp;
                            <span><a href="{{ empty($post->user->website)?"":$post->user->website  }}" target="_blank"><i class="fa fa-fw fa-home"></i>Website</a></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 10px">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h5>作者文章</h5>
                    </div>
                    <ol>
                        @foreach($post->user->posts as $each_post)
                            <li>
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <a class="post_a" href="{{ route('article',['id'=>$each_post->id]) }}" style="font-size: 5px;">{{ $each_post->title }}</a>&nbsp;&nbsp;
                                </div>
                                <span class="badge">{{ $each_post->view }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
    </div>
</body>
</html>