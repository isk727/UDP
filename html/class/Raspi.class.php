<?php
if (is_file(dirname(__FILE__)."/DatasetBean.class.php")) { require_once(dirname(__FILE__)."/DatasetBean.class.php"); }
class RaspiBean extends DatasetBean {
	public function makeQuery() {
		$query = "select ".
					"id,".
					"ip,".
					"name,".
					"image ".
					"from raspi ".
					"where ".$this->where." ";
		if ($this->orderby == '') {
			$query .= "order by id";
		} else {
			$query .= "order by ".$this->orderby;
		}
		if ($this->limit != '') {
			$query .= " limit ".$this->limit;
		}
		return $query;
	}

	public function setSID($rid, $sid, $uid) {
		$pdo = $this->getPDO();
		if ($pdo == null) {
			exit;
		}
		$sql = "update raspi set session_id=:sid,start_date=now(),player=:uid,json_id='12345' where id=:rid";
		$sth = $pdo->prepare($sql);
		$sth->bindValue(':sid', $sid);
		$sth->bindValue(':uid', $uid);
		$sth->bindValue(':rid', $rid);
		$sth->execute();

		$point = "1000";
		$sql = "insert into raspi_history (raspi_id,user_id,io,`point`,`date`,session_id) values (:rid,:uid,1,:point,now(),:sid)";
		$sth = $pdo->prepare($sql);
		$sth->bindValue(':sid', $sid);
		$sth->bindValue(':uid', $uid);
		$sth->bindValue(':point', $point);
		$sth->bindValue(':rid', $rid);
		return ($sth->execute());
	}

	public function getEntries() {
		$pdo = $this->getPDO();
		if ($pdo == null) {
			exit;
		}
		$stmt = $pdo->query($this->makeQuery());
		$rows = $stmt->fetchAll();
		$this->count = $stmt->rowCount();
		$entries = array();
		foreach ($rows as $rs) {
			$raspi = new Raspi();
			$raspi->setFromRow($rs);
			$entries[] = $raspi;
		}
		return $entries;
	}

	public function getMaintenance() {
		$sb = new SettingBean();
		return ($sb->getKeyValue("MAINTENANCE") == "1" ? 1 : 0);
	}
	
	public function changeIp($id, $ip) {
		$pdo = $this->getPDO();
		if ($pdo == null) {
			exit;
		}
		$sql = "update raspi set ip=:ip where id=:id";
		$sth = $pdo->prepare($sql);
		$sth->bindValue(':ip', $ip);
		$sth->bindValue(':id', $id);
		$rrr = $sth->execute();
		return $rrr;
	}
}

class Raspi
{
	public $id = '0';
	public $ip = '';
	public $name = '';
	public $image = '';

	public function setFromRow($row) {
		$this->id = $row['id'];
		$this->ip = $row['ip'];
		$this->name = $row['name'];
		$this->image = $row['image'];
	}

	public function sortOrderOption() {
		$rb = new RaspiBean();
		$rb->where = "`status`>=0";
		$rp = $rb->getEntries();
		$i = 0;
		$ret = "";
		foreach($rp as $r) {
			if ($this->sort_order == ($i + 1)) {
				$ret .= "<option selected value='".$this->id."-".($i+1)."'>".($i + 1)."</option>";
			} else {
				$ret .= "<option value='".$this->id."-".($i+1)."'>".($i + 1)."</option>";
			}
			$i++;
		}
		return $ret;
	}

	public function settingOption() {
		$ret = "";
		for ($i = 0; $i < 6; $i++) {
			if ($this->setting == ($i+1)) {
				$ret .= "<option value='".($i+1)."' selected>".($i+1)."</option>";
			} else {
				$ret .= "<option value='".($i+1)."'>".($i+1)."</option>";
			}
		}
		return $ret;
	}
}
?>
