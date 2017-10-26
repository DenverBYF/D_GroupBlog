<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/jquery.fullpage.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <style>
            body {
                background: url("img/back.png") repeat;
            }
            p,a {
                color: #FFFFFF;
            }
        </style>
        <!-- Styles -->
    </head>
    <body>
        <div id="dowebok">
            <div class="section">
                <div style="text-align:center;">
                    <img src="{{ "../storage/app/public/group/".$group->url }}" class="img-circle" >
                    <h3 style="text-align:center; color: #FFFFFF">{{ $group->name }}</h3>
                    <a href="#about" style="font-size: 20px">关于</a>&nbsp;&nbsp;| &nbsp;
                    <a href="#blog" style="font-size: 20px">博客</a>
                </div>
            </div>
            <div class="section">
                <div class="container">
                    <div id="team" style="height: 60%">
                        <h2 style="color: #FFFFFF"><u>团队介绍</u></h2>
                        @foreach(explode("\n",$group->desc) as $each_p)
                            <p style="font-size: 20px">{{ $each_p }}</p>
                        @endforeach
                    </div>
                    <div id="member">
                        <h2 style="color: #FFFFFF"><u>团队部分成员</u></h2>
                        @foreach($user as $each_user)
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                    <p style="font-size: 18px">{{ $each_user->name }}</p>
                                    <figure style="width: 80px;height: 80px">
                                        <img class="img-circle img-responsive"  src="{{ empty($each_user->url)?"../storage/app/public/user/default.jpeg":"../storage/app/public/user/".$each_user->url }}" data-toggle="tooltip" data-placement="top" title="{{ empty($each_user->sign)?"":$each_user->sign }}" >
                                    </figure>
                                    <p style="font-size: 15px">{{ empty($each_user->key_word)?"":$each_user->key_word }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-8">
                            <h2 style="color: #FFFFFF" >文章列表</h2>
                            <ol>
                                @foreach($posts as $each_post)
                                    <li>
                                        <h3>
                                            <a href="{{ route('article',['id'=>$each_post->id]) }}" >{{ $each_post->title }}</a>&nbsp;&nbsp;
                                        </h3>
                                        <img class="img-circle img-responsive" style="width: 35px;height: 35px" src="{{ empty($each_post->user->url)?"../storage/app/public/user/default.jpeg":"../storage/app/public/user/".$each_post->user->url }}" >
                                        <p style="font-size: 10px">{{ $each_post->user->name }}</p>
                                        <p>
                                            <span>
                                                <i class="glyphicon glyphicon-calendar"></i>&nbsp;{{ $each_post->created_at }}&nbsp;&nbsp;
                                                <i class="glyphicon glyphicon-tag"></i>&nbsp;{{ $each_post->tag->name }}&nbsp;&nbsp;
                                                <i class="glyphicon glyphicon-eye-open"></i>&nbsp;{{ $each_post->view }}
                                            </span>
                                        </p>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                    {{--{{ $posts->links() }}--}}
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.fullpage.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $('#dowebok').fullpage({
                anchors: ['index','about', 'blog'],
            });
        });
    </script>
</html>
