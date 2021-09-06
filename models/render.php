<?

/**
 * 
 */
class Render extends base
{

	public function templateRender($keye)
	{


		$template = $this->query('SELECT key FROM templates');

		$template = $this->fetch($template);

		$html = $keye;

		$preg = preg_split('{'.$template.'}', $keye);
		echo '<pre>';
		var_dump( explode(' ', $preg[0]));
		echo '</pre>';

		// echo $html;
		

		



	}

	public function put_plagins($key)
	{
		$template = $this->query('SELECT * FROM templates WHERE key = "'.$key.'"');

		$array_ = $this->fetch($template);



		echo $array_[0]['data']; 
	}
}

$render = new Render();