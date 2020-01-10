<?php //2020.1.8 ?>

<?php 
	//退出用户登录
	setcookie('user_id', '', time()-1);	//清除cookie
	echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";		//设置立即跳转
	exit();		//到这里停止运行
?>