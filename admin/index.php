<?
require_once $_SERVER['DOCUMENT_ROOT']."/models/init.php";
require_once $_SERVER['DOCUMENT_ROOT']."/models/define_config.php";

session_start();
if ($base->check_hash(session_id())){
	$auth_sucsess=true;
	header("location: /admin/settings");
}else{
	$auth_sucsess=false;
}


if (!CACHE) 
	header("Cache-Control: no-store, no-cache, must-revalidate");

if (DEBUG){
	ini_set('error_reporting', E_ALL);

	echo "<pre class='debug_output'>";
	var_dump($constants);

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
	<? 
		if ($auth_sucsess){

		}else{
			echo '<div class="block">
		       	<input type="text" class="input_auth" placeholder="login" id="login">
		       	<input type="password" class="input_auth bot" placeholder="Password" id="pass">
		    </div>';
		}
	?>
    
    <div class="admin_panel" <? if ($auth_sucsess) {echo "style='display: block'"; } ?> >
    	<div class="menu_panel">
    		<ul>
    			<li>Templates</li>
    			<li>Pages</li>
    			<li>Feeds</li>
    			<li>Plagins</li>
    			<li>Support</li>
    			<li>About</li>
    			<li style="float: right;" onclick="exit(this)">Exit</li>
    		</ul>
    	</div>
    </div>
</div>
<div class="showInfo"></div>

<script type="text/javascript">
	$(document).ready(function(){
		


		$('body').keyup(function(){
		    if(event.keyCode==13)
	       	{	

	       		$.post( 
	       			"/ajax_php/auth.php",
	       			{ 
	       				login: $('#login').val(),
	       				pass: $('#pass').val()
	       			}, 
	       			returnData
	       		);

	       		function returnData(data){

	       			 var data = JSON.parse(data)

	       			 console.log(data)

	       			if (data.sucsess)
		       		{
		       			$('.block').css({'display': 'none'})
		       				
		       			location.href = '/admin/settings'
		       			
		       		}else{
		       			$('.block').css('box-shadow',' 0 0 20px 0px rgba(255, 0, 0, 0.9)')
		       			$('.showInfo').html('Неверный логин/пароль');
		       			
		       			$('.showInfo').animate({'bottom': '15%'}, 400, function(){
		       				$('#pass').val('')

		       				$('.showInfo').animate({'bottom': '12%'}, 300)
				          	setTimeout(
			          		function(){
			          				$('.block').css('box-shadow','0 0 10px rgba(0,0,0,0.1)')
			          				$('.showInfo').animate({'bottom': '15%'},200)
			          				$('.showInfo').animate({'bottom': '-400px'},200)
			          				
			          		},2300);
			          		
	    	  			})
		       			

		       		}
	       		}

	       		
          		
	       	}
		})
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
	
</script>
</body>
</html>