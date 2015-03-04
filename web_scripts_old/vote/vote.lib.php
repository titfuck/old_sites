<?php

class VoteSystem {
	private $ssl;
	private $vote;

	function VoteSystem() {
		$this->ssl = getSSL();
		if (empty($this->ssl)) {
			header('Location: https://scripts-cert.mit.edu/~tdc/vote/');
			exit;
		}
		session_start();

		$session_default = array(
			'started'=>0,
			'can_vote'=>0,
			'can_admin'=>0
		);

		foreach($session_default as $k=>$v)
		if (!array_key_exists($k,$_SESSION))
			$_SESSION[$k] = $v;

		$fc = $this->fileCheck();
		if ($_SESSION['started'] != $fc) {
			echo 'starting';
			$_SESSION['started'] = $fc;
			if ($this->checkUser($this->ssl['user'],'vote')) $_SESSION['can_vote'] = 1;
			if ($this->checkUser($this->ssl['user'],'admin')) $_SESSION['can_admin'] = 1;
		}
		$this->vote = $this->loadVotes();
	}

	function hasAccess() {
		return $_SESSION['can_vote']==1||$_SESSION['can_admin']==1;
	}

	private function fileCheck() {
		$i = 0;
		foreach(glob('users/*') as $f)
			$i += filemtime($f);
		return $i;
	}

	private function checkUser($u,$t) {
		$b = $this->loadUsers($t);
		return in_array($u,$b);
	}

	private function loadUsers($t) {
		$b = array();
		$f = explode("\n",file_get_contents('users/'.$t));
		foreach($f as $l) {
			$l = trim($l);
			if (stristr($l,'@') || stristr($l,' ') || empty($l))
				continue;
			$b[] = strtolower($l);
		}
		return $b;
	}
	
	function getVoter() {
		return $this->ssl;
	}

	function getVotes() {
		return $this->vote;
	}
	
	private function createFile($t, $p) {
		$path = dirname(__file__).'/'.$p;
		$dir = dirname($path);
		`mkdir -p $dir`;

		switch($t) {
			case 'main':
				$out = array();
				foreach(glob('data/*') as $d) {
					if (!is_dir($d)) continue;
					$out[array_pop(explode('/',$d))] = array('title'=>@trim(file_get_contents($d.'/_title')),
															'active'=>1);
				}
				break;
		}
		if (isset($out))
			file_put_contents($path, serialize($out));
	}
	
	private function loadVotes() {
		$f = @unserialize(file_get_contents('data/0'));
		if (empty($f)) {
			$this->createFile('main','data/0');
			header('Location: '.$_SERVER['REQUEST_URI']);
			exit;
		}
		return $f;
	}

	private function saveVotes() {
		file_put_contents('data/0', serialize($this->vote));
	}

	function close() {
	}

	function newVote($title) {
		$time = time();
		$title = trim(strip_tags($title));
		$this->vote[$time] = array('title'=>$title);
		$this->saveVotes();
		`mkdir -p data/$time`;
		file_put_contents('data/'.$time.'/_title',$title);
	}
}

class Vote {
	function Vote($id) {
	}
}

function getSSL() {
	if (array_key_exists('SSL_CLIENT_VERIFY',$_SERVER)
		&& $_SERVER['SSL_CLIENT_VERIFY'] == 'SUCCESS') {

		$ret = array();
		$dn = explode('/',$_SERVER['SSL_CLIENT_S_DN']);
		foreach($dn as $opt) {
			if (array_shift(explode('=',$opt)) == 'CN')
				$ret['name'] = substr($opt,3);
			if (array_shift(explode('=',$opt)) == 'emailAddress')
				$ret['email'] = substr($opt,13);
		}
		$ret['user'] = strtolower(array_shift(explode('@',$ret['email'])));
		return $ret;
	}
}

?>
