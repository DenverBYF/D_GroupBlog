# D_GroupBlog

* 基于Laravel5.5开发的团队博客系统，支持Markdown语法。  

## 功能
* Markdown语法编辑文章
* 邀请码注册
* 文章管理
* 人员管理
* 标签管理
* 友情链接
* 团队及成员介绍
* 评论功能(Markdown语法书写)
* .......未完待续  

## Usage
* `git clone https://github.com/DenverBYF/D_GroupBlog.git`  
&nbsp;&nbsp;进入项目文件夹:  
* `cp .env.example .env`  
&nbsp;&nbsp;修改.env配置，配置mysql数据库。  
* `composer install`  
* `php artisan migrate`生成数据库文件  
* 运行命令`php artisan blog:run admin admin@example.com password`创建超级管理员 其中三个参数分别为管理员名称  邮箱  密码  
* `php artisan key:gen`  
* `chmod -R 777 storage/`  
* 访问'localhost/D_GroupBlog/public/'即为主页面  
* 'localhost/D_GroupBlog/public/home'为后台入口。。  
* 在管理页面中的成员管理中可生成邀请码。成员注册需填写邀请码才可进行注册。

## 效果图
* 主页面 
![](http://oeix47n80.bkt.clouddn.com/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-10-30%20%E4%B8%8B%E5%8D%887.13.54.png)  
* 团队介绍
![](http://oeix47n80.bkt.clouddn.com/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-10-30%20%E4%B8%8B%E5%8D%887.13.57.png)  
* 博客
![](http://oeix47n80.bkt.clouddn.com/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-10-30%20%E4%B8%8B%E5%8D%887.13.59.png)
* 管理员后台 
![](http://oeix47n80.bkt.clouddn.com/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-10-30%20%E4%B8%8B%E5%8D%887.11.33.png)
* 团队设置 
![](http://oeix47n80.bkt.clouddn.com/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-10-30%20%E4%B8%8B%E5%8D%887.11.27.png)
* 人员管理
![](http://oeix47n80.bkt.clouddn.com/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-10-30%20%E4%B8%8B%E5%8D%887.11.43.png)
* 成员页面
![](http://oeix47n80.bkt.clouddn.com/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-10-30%20%E4%B8%8B%E5%8D%887.12.17.png)
* 文章发布
![](http://oeix47n80.bkt.clouddn.com/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-10-30%20%E4%B8%8B%E5%8D%887.13.37.png)


