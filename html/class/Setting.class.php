<?php
if (is_file(dirname(__FILE__)."/DatasetBean.class.php")) { require_once(dirname(__FILE__)."/DatasetBean.class.php"); }
class SettingBean extends DatasetBean {
	public function makeQuery() {
		$query = "select ".
					"id,".
					"`key`,".
					"`val`, ".
					"`btn` ".
					"from setting ".
					"where ".$this->where." ".
					"order by id";
		return $query;
	}

	public function getEntries() {
		$pdo = $this->getPDO();
		if ($pdo == null) {
			exit;
		}
		$stmt = $pdo->query($this->makeQuery());
		$this->count = $stmt->rowCount();
		$rows = $stmt->fetchAll();
		$entries = array();
		foreach ($rows as $rs) {
			$setting = new Setting();
			$setting->setFromRow($rs);
			$entries[] = $setting;
		}
		return $entries;
	}

	public function getKeyValue($key) {
		$this->where="`key`='".$key."'";
		$setting = $this->getEntries();
		if (count($setting) == 1) {
			return ($setting[0]->value);
		} else {
			return "";
		}
	}

	public function getValues() {
		$this->where = "`key`<>''";
		$settings = $this->getEntries();
		$array = array();
		foreach($settings as $setting) {
			$array += array($setting->key => $setting->value);
		}
		return $array;
	}


	public function getKeyButton($key) {
		$this->where="`key`='".$key."'";
		$setting = $this->getEntries();
		if (count($setting) == 1) {
			return ($setting[0]->btn);
		} else {
			return "";
		}
	}

	public function getButtons() {
		$this->where = "`key`<>''";
		$settings = $this->getEntries();
		$array = array();
		foreach($settings as $setting) {
			$array += array($setting->key => $setting->btn);
		}
		return $array;
	}

	public function saveKeyValue($key, $val) {
		$pdo = $this->getPDO();
		if ($pdo == null) {
			exit;
		}
		$sql = "update setting set val=:v where `key`=:k";
		$sth = $pdo->prepare($sql);
		$sth->bindValue(':v', $val);
		$sth->bindValue(':k', $key);
		$sth->execute();
	}
}

class Setting
{
	public $id = '0';
	public $key = '';
	public $value = '';
	public $btn = '';
	public function setFromRow($row) {
		$this->id = $row['id'];
		$this->key = $row['key'];
		$this->value = $row['val'];
		$this->btn = $row['btn'];
	}
}
?>
