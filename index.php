<?
require_once 'models/define_config.php';


$check_template = $base->title_template();

foreach ($check_template as $key => $value) {
	if ($check_template[$key]['active']){
		$render->templateRender(
			file_get_contents('templates/'.$check_template[$key]['title'].'/index.php')
		);
	}
}