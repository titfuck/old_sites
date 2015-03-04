<?php
/*
    (c) 2005 Joe Presbrey
    joepresbrey@gmail.com
*/

function isPost() {
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    return true;
  } else {
    return false;
  }
}
function isFormPost() { return isPost(); }

function isSess($id) {
  return isset($_SESSION[$id]);
}

function sess($id,$val=null) {
  if (is_null($val)) {
    return (isSess($id)?$_SESSION[$id]:null);
  } elseif (empty($val)) {
    unset($_SESSION[$id]);
  } else {
    $prev = sess($id);
    $_SESSION[$id] = $val;
    return $prev;
  }
}

function stopSess() {
  $sid[] = session_id();
  @session_destroy();
  session_start();
  $sid[] = session_id();
  session_regenerate_id();
  $sid[] = session_id();
  session_write_close();
  @session_destroy();

  foreach($sid as $id) {
    @unlink(session_save_path().'/sess_'.$id);
  }
}

function sessTime($query=null) {
  global $timingc;
  global $timings;

  if(!isset($timings)) {
    $timings = array();
  }

  if (!isset($timingc) || empty($timingc)) {
	$timingc = 1;
  } elseif (!is_null($query)) {
    $current = $timingc;
	$timingc = ++$current;
  }
  $key = $timingc;

  if (is_null($query)) {
    $timings[$key]['time'] = microtime(true)-$timings[$key]['time'];
	if (mysql_error())
		$timings[$key]['error'] = mysql_error();
    return true;
  } else {
    $timings[$key] = array();
    $timings[$key]['time'] = microtime(true);
    $timings[$key]['query'] = $query;
    return false;
  }
}

function fetchRows($rs, $key = null) {
    if (!$rs) return array();
    $kn = is_null($key);
    $n = mysql_num_rows($rs);
    if ($n > 0) {
        $arr = array();
        if (is_null($key)) {
            while ($r = mysql_fetch_assoc($rs)) {
                $arr[] = $r;
            }
        } elseif (is_numeric($key)) {
            while ($r = mysql_fetch_row($rs)) {
                $arr[$r[$key]] = $r;
            }
        } else {
            while ($r = mysql_fetch_assoc($rs)) {
                $arr[$r[$key]] = $r;
            }
        }
        mysql_free_result($rs);
        return $arr;
    } else {
        mysql_free_result($rs);
        return array();
    }
}

function printErrors($err) { printList('err', $err); }
function printMsgs($err) { printList('msg', $err); }

function printList($class,$err) {
    if (is_array($err) && count($err)) {
        echo '<div class="',$class,'">',(count($err)>1?'<ul>':'');
        foreach($err as $e) {
			if (count($err)>1) {
				echo '<li><p>',$e,'</p></li>';
			} else {
				echo '<p>',$e,'</p>';
			}
        }
        echo (count($err)>1?'</ul>':''),'</div>';
    }
}

function buildSQLSet($fields, $values=null) {
    $ex = array('NOW()','NULL');
    $sql = 'SET';
    $c = 0;
    if (!is_null($values)) {
        foreach($fields as $field) {
            if ($c++) $sql .= ',';
            $sql .= " `$field`='".mysql_escape_string(array_shift($values))."'";
        }
    } else {
        foreach($fields as $field=>$value) {
            if ($c++) $sql .= ',';
            if (in_array($value,$ex)) {
                $sql .= " `$field`= $value";
            } else {
                $sql .= " `$field`='".mysql_escape_string($value)."'";
            }
        }
    }
    return $sql;
}

function buildSQLInsert($array, $table=null) {
    $ex = array('NOW()','NULL');
    $sql = '(';
    $c = 0;
    foreach($array as $field=>$value) {
        if ($c++) $sql .= ',';
        $sql .= " `$field` ";
    }
    $sql .= ') VALUES (';
    $c = 0;
       foreach($array as $field=>$value) {
        $v = mysql_escape_string($value);
        if ($c++) $sql .= ',';
        if (in_array($v, $ex))
            $sql .= " $v ";
        else
            $sql .= " '$v' ";
    }
    $sql .= ')';
    return (is_null($table)?$sql:('INSERT INTO `'.$table.'` '.$table));
}

function build_str($query_array) {
    $query_string = array();
    foreach ($query_array as $k => $v) {
        $new = $k;
        if (strlen($v))
            $new .= '='.$v;
        $query_string[] = $new;
    }
    return join('&', $query_string);
}

function newQS($key, $val=null) {
    return newQSA(array($key=>$val));
}

function newQSA($array=array()) {
    parse_str($_SERVER['QUERY_STRING'], $arr);
    $s = count($arr);
    foreach($array as $key=>$val) {
        $arr[$key] = $val;
        if (is_null($val))
            unset($arr[$key]);
    }
    return (count($arr)||$s)?'?'.build_str($arr):'';
}

function formQSA($array=array()) {
    if (!count($array)) $array = $_SERVER['QUERY_STRING'];
    parse_str($array, $arr);
    $text = '';
    foreach($arr as $key=>$val) {
        $text .= sprintf('<input type="hidden" name="%s" value="%s">', $key, $val);
    }
    return $text;
}

?>
