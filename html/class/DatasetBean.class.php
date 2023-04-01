<?php
if (is_file(dirname(__FILE__)."/../config.php")) { require_once(dirname(__FILE__)."/../config.php"); }
class DatasetBean {
	public $id = '';
	public $query = '';
	public $where = '';
	public $groupby = '';
	public $orderby = '';
	public $offset = 0;
	public $limit = 0;
	public $page_count = 0;
	public $page_max = 0;
	public $count = 0;

	public function getPDO() {
		try {
			$pdo = new PDO('sqlite:'._DBPATH);
			return $pdo;
		} catch (PDOException $e) {
			return null;
		}
	}
	public function makeQuery() {
		$query = "";
		return $query;
	}
	public function getEntries() {
		$entries = array();
		return $entries;
	}

	public function getPageEntries($pg) {
		$pgentries = array();
		if ($pg > $this->getPageCount() || $pg < 1) {
			return $pgentries;
		}
		$start = ($pg - 1) * $this->page_max;
		$end = min($this->count, ($pg * $this->page_max));
		$entries = $this->getEntries();
		for ($i = $start; $i < $end; $i++) {
			$pgentries[] = $entries[$i];
		}
		return $pgentries;
	}
	public function setPageMax($max) {
		$this->page_max = $max;
	}
	public function getPageMax() {
		return $this->page_max;
	}
	public function getPageCount() {
		return ceil($this->count/$this->page_max);
	}
}
?>
