<?

require 'render.php';

class Base extends SQLite3
{
	

	function __construct()
	{
		$this->open($_SERVER['DOCUMENT_ROOT'].'/db/qsmc_base.db');
	}

	public function define_get () 
	{
		$data = $this->query('SELECT * FROM define');
		return $this->fetch($data);
	}

	public function check_data($login, $pass)
	{
		$data = $this->query('SELECT * FROM auth_users WHERE login = "'.$login.'" and pass = "'.$pass.'"');
		return $this->fetch($data);
	}


	public function insert_hash ($hash, $login)
	{
		$data = $this->query('UPDATE auth_users SET hash = "'.$hash.'"  WHERE login = "'.$login.'" ');

		return $data;
	}


	public function check_hash ($hash)
	{
		$data = $this->query('SELECT hash FROM auth_users WHERE hash = "'.$hash.'"');

		return $this->fetch($data);
	}

	public function fetch($result)
	{
		$retval = array();
		while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
			$retval[] = $row;
		}
		return $retval;
	}

	public function getLang ($lang)
	{
		if (empty($lang))
			$lang="en";
		$data = $this->query('SELECT * FROM lang WHERE lang = "'.$lang.'"');

		return $this->fetch($data);
	}

	public function title_template()
	{
		$data = $this->query('SELECT * FROM title_template');
		return $this->fetch($data);
	}
}

$base = new Base();
