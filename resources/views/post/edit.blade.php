@extends('adminlte::page')

@section('title', '新建文章')


@section('content_header')
    <h1>编辑文章</h1>
@stop

@section('content')
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" method="post"  id="post-form" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group col-md-8 col-lg-8">
                    <label for="title">文章标题</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <input type="text" class="form-control" name="title" id="title" placeholder="文章标题"  value="{{ $article->title }}">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-8 col-lg-8">
                    <label for="tag">文章标签</label>
                    <div class="row">
                        <div class="col-md-8 col-lg-8">
                            <input type="text" class="form-control" name="tag" id="tag" placeholder="文章标签" list="tag_list" onkeyup="get_tag(this.value)" value="{{ $article->tag->name }}">
                            <datalist id="tag_list">
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-10 col-lg-10">
                    <label for="content">文章内容(markdown语法)</label>
                    <div class="row">
                        <div class="col-md-10 col-lg-10" id="editormd">
                            <textarea class="editormd-markdown-textarea" style="display:none;" id="content" name="content">{{ $article->content }}</textarea>
                            <textarea style="display:none;"  name="html_content" id="html_content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button  type="button" onclick="get_html_ajax('{{ $url }}')" id="ajax" class="btn-lg btn-success">更新</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $(function() {
            editor = editormd("editormd", {
                path:"{{ asset('editormd/lib') }}"+"/",
                height: 800,
                syncScrolling: "single",
                toolbarAutoFixed: false,
                saveHTMLToTextarea: false,
            });
        });
        function get_html_ajax(route){
            var html_content = editor.getPreviewedHTML();
            $("#html_content").val(html_content);
            $.ajax({
                url: route,
                data:$("form").serialize(),
                type:"PUT",
                dataType:"text",
                success:function (data) {
                    bootbox.alert("<a href=\"{{ route('article.index') }}\">文章发布成功</a>",function(){
                        window.location.reload();
                    });
                },
                error:function(e){
                    bootbox.alert("发布失败");
                }
            });
        }
        function get_tag(value)
        {
            $.ajax({
                url:"{{ route('search_tag') }}",
                type:"GET",
                data:"data="+value,
                dataType:"json",
                success:function (data) {
                    //var tag_list = JSON.parse(data);
                    for (var i=0 ;i<data.length;i++){
                        var tmp = $("<option></option>");
                        tmp.attr('value',data[i].name);
                        $("#tag_list").html(tmp);
                    }
                }
            })
        }
        $("#post-form").bootstrapValidator({
            message: '这个值没有被验证',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields:{
                title:{
                    validators:{
                        notEmpty:{
                            message:"文章题目不能为空"
                        }
                    }
                },
                tag:{
                    validators:{
                        notEmpty:{
                            message:"文章标签不能为空"
                        }
                    }
                }
            }
        });

    </script>
@stop


