<?php //2020.1.8 ?>

<?php 
 	    #"                   _ooOoo_",
        #"                  o8888888o",
        #"                 88\" . \"88",
        #"                  (| -_- |)",
        #"                 O\\  =  /O",
        #"               ____/`---'\\____",
        #"             .'  \\\\|     |//  `.",
        #"            /  \\\\|||  :  |||//  \\",
        #"           /  _||||| -:- |||||-  \\",
        #"           |   | \\\\\\  -  /// |   |",
        #"           | \\_|  ''\\---/''  |   |",
        #"           \\  .-\\__  `-`  ___/-. /",
        #"         ___`. .'  /--.--\\  `. . __",
        #"      .\"\" '<  `.___\\_<|>_/___.'  >'\"\".",
        #"     | | :  `- \\`.;`\\ _ /`;.`/ - ` : | |",
        #"     \\  \\ `-.   \\_ __\\ /__ _/   .-` /  /",
        #"======`-.____`-.___\\_____/___.-`____.-'======",
        #"                   `=---='",
        #"^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^",
        #"        		 佛祖保佑      永无BUG
        #"              Buddha bless, never bug 

?>



<?php 
	//主页
	require_once('Function library.php');
	require_once('Shopping Link.php');

	$log = 0;	//登录信息 为0则未登录 1为登录
	$user_name = ''; 
	$dbc_sql = mysqli_connect('127.0.0.1', 'root', '', 'web_user_info_data', 3306) or header('Location:error.html');  //如果出错则重定向至错误页面

	if(isset($_COOKIE['user_id'])) // 判断用户是否登录
		{
			if(!cookie_if())	//判断cookie是否过期
				{
					$log = 1;	//如果已经登录改变状态
					$c = $_COOKIE['user_id'];
					$query = "SELECT user_name FROM web_cookie_table WHERE cookie = '$c'";	//查询用户名

					$data = mysqli_query($dbc_sql, $query);		//数据库查询
					$row = mysqli_fetch_array($data);			//获取用户名
					$user_name = $row['user_name'];				//输出用户名
				}
			else
			setcookie('user_id', '', time()-1);	//清除cookie
		}
	//继续执行
?>

<!DOCTYPE html>
<html>
<head>
	<title>购物9527</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>
	<div class="header">		<!-- 导航栏 -->
		<ul class="header_ul">	
			<?php 
				if($log)
					{
						echo '<li><a href="#" class="header_ul_a"><img src="img/user.png"  height="14" width="14" style="margin-top:2px;" /><font size="3">'.$user_name.'</font></a></li>';
						echo '<li>|</li>';
						echo '<li><a href="#" class="header_ul_a"><font size="2">购物车</font></a></li>';
						echo '<li>|</li>';
						echo '<li><a href="log out.php" class="header_ul_a"><font size="2">退出</font></a></li>';
					}
					else
					{
						echo '<li><a href="regis.php" class="header_ul_a"><font size="2">注册</font></a></li>';
						echo '<li>|</li>';
						echo '<li><a href="login.php" class="header_ul_a"><font size="2">登录</font></a></li>';
					}
			?>
		</ul>
	</div>

	<div class="frame"></div>

	<div class="Shopping_Home">		<!-- 购物主页 -->
		<div class="Above">
			<div class="Side_n_b">		<!-- 次导航栏 -->
				<ul class="Side_n_b_ul">
					<li>苹果</li>
					<li>小米</li>
					<li>oppo</li>
					<li>三星</li>
					<li>华为</li>
				</ul>
			</div>

			<div class="Shopping_page">	
				<a href=<?php echo $Above_1; ?>>
					<img src="img/1.webp" height="410" width="680" />
					<h5>AMD，yes 最强处理器</h5>
					<font size="2">现在购买立享优惠</font>
				</a>		
			</div>

			<div style="width: 35px; height: 1px; display: inline-block;"></div>

			<div class="Shopping_page_1">
				<a href=<?php echo $Above_2; ?>>
					<img src="img/2.jpg" height="360" width="360" />
					<h5>5499</h5>
					<font size="2">全网最低价</font>
				</a>
			</div>

			<div class="Shopping_page_2">
				<a href=<?php echo $Above_3; ?>>
					<img src="img/3.png" width="250" /><br /><br />
					<h5>首发骁龙865</h5>
					<font size="2">最低价865</font>
				</a>
			</div>

			<div class="Shopping_page_3">
				<a href=<?php echo $Above_4; ?>>
					<img src="img/4.jpg" width="310" height="310" /><br /><br />
					<h5>强劲A13</h5>
					<font size="2">双摄像头</font>
				</a>
			</div>

			<div class="Shopping_page_4">
				<a href=<?php echo $Above_5; ?>>
					<img src="img/5.jpg" width="250" height="310" /><br /><br />
					<h5>强劲A13</h5>
					<font size="2">三摄像头</font>
				</a>
			</div>

			<div class="Shopping_page_5">
				<a href=<?php echo $Above_6; ?>>
					<img src="img/6.jpg" width="320" height="310" /><br /><br />
					<h5>谁还买小米</h5>
					<font size="2">大米不香吗？</font>
				</a>
			</div>
			
		</div>
	</div>

</body>
</html>