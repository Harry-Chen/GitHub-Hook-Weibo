GitHub-Hook-Weibo
=================

A GtiHub post-receive hook written in PHP which sends a weibo after each commit

TODO List
================

* <del> 通过页面设置微博登录信息</del>(不再需要)
* 通过页面设置每个Repo对应的提醒人员(已实现最基本的添加)
* 在上述情况下可以通过微博API自动更新用户的昵称（蛋疼）
* 各种错误处理 
* 前端页面美化(由@JoyNeop实现)

Some Comments
================

* 使用新浪微博登陆，不提供独立账户，使用新浪微博UID识别用户
* 使用统一微博账号发送提醒(待定)
* 使用 `Owner/Repo` 字符串标明Repo,登记时填写repo地址
* 使用微博UID标明要提到的人