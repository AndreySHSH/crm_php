<?
require_once $_SERVER['DOCUMENT_ROOT']."/models/init.php";
require_once $_SERVER['DOCUMENT_ROOT']."/models/define_config.php";

session_start();
if ($base->check_hash(session_id())){
	$auth_sucsess=true;
}else{
	$auth_sucsess=false;
	header("location: /admin");
}

$get_lang = $_GET['lang'];


$lang_ar = json_decode($base->getLang($get_lang)[0]['array'], true);


if (!CACHE) 
	header("Cache-Control: no-store, no-cache, must-revalidate");

if (DEBUG){
	ini_set('error_reporting', E_ALL);

	echo "<pre class='debug_output'>";
	var_dump(json_decode($base->getLang('ru')[0]['array'], true));

	echo "

	</pre>";
}




?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/css/all.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<div class="debug">ADMIN: DEBUG on enabled --> click for show traceback</div>
<div class="title">
	Welcome SH.CMS
	<div class="back" onclick="location.href = '/'"><? echo $_SERVER['SERVER_NAME']; ?></div>
</div>

<div class="parent">
    
    <div class="admin_panel" >
    	<div class="menu_panel" >
    		<ul id="menu">
    			<li onclick="location.href = 'templates'" ><? echo $lang_ar['Templates'] ?></li>
    			<li><? echo $lang_ar['Pages'] ?></li>
    			<li><? echo $lang_ar['Feeds'] ?></li>
    			<li><? echo $lang_ar['Bots'] ?></li>
    			<li style="background: rgba(85, 141, 255, 0.06);">Plagins</li>
    			<li>Support</li>
    			<li>About</li>
    			<li style="float: right;" onclick="exit(this)">
    				<img src="/icon/exit.svg">
    			</li>
    		</ul>
    	</div>
    	<div class="content">

    		<div class="content_rewrite">
    			<table class="plaginsrow">

					<tr>
						<th>Title</th>
						<th>About</th>
						<th>Active</th>
					</tr>
					<tr>
						<td>RedisConnect</td>
						<td>.</td>
						<td>
							<select name="select2">
								<option selected="selected">off</option>
								<option>on</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>HydraUpdateController</td>
						<td>.</td>
						<td>
							<select name="select2">
								<option selected="selected">off</option>
								<option>on</option>
							</select>
						</td>
					</tr>
  				</table>
    			<!-- <button id="new_template">Создать шаблон</button> -->
    		</div>

    	</div>
    </div>
</div>
<div class="showInfo"></div>

<script type="text/javascript">
	$(window).ready(function(){

		
		

		$('.admin_panel').slideDown(1)
		
		var DEBUG = <? if (DEBUG) { echo DEBUG; }else{  echo '0'; } ?>;
		if (DEBUG){
			$('.debug').show()
			$('.debug').click(function(){
				var dis = $('.debug_output').css('display')
				if (dis == 'none'){
					$('.debug_output').fadeIn(300);
				}else{
					$('.debug_output').fadeOut(300);
				}

			})
		
		}


	})
	function exit(e){
			document.cookie = 'PHPSESSID=';
			location.reload()
	}

	$('#menu').children().click(function (e) {
		var buttonEvent = e.currentTarget.innerHTML;
		console.log(buttonEvent)


		$.post( 
   			"/ajax_php/settings_menu_query.php",
   			{ 
   				buttonEvent: buttonEvent
   			}, 
   			returnData
   		);

   		function returnData (data)
   		{
   			$('.content_prew').html('')
   			var data = JSON.parse(data)
   			var html = new Array();

   			for (var i = data.length - 1; i >= 0; i--) {
   				var block_data = $('.content_prew').html()
   				$('.content_prew').html(block_data+"<li>"+data[i]['key']+"</li>")
   			}
   			console.log(html)
   			
   		}
	});
	
</script>
</body>
</html>