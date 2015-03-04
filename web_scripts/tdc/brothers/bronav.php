<?php
# These functions generate the left-right navigation on each brother page.
# They also provide a conveniant way to get a list of brothers from each year.
# For these functions to work, the brother pages should be located in 
# /mit/tdc/web_scripts/tdc/brothers/YYYY
# where YYYY is the four-digit pledge class year.
# Each brother page should be named like so:
# <pledge number>_<brother name>.php
# For example:
# 5_Francisco Saldana.php

function cmp($a, $b) {
  # Sorts the list of brother pages in a year by their pledge number.
  # (used in get_brother_pages)
  $na = explode('_', $a[0], 1);
  $nb = explode('_', $b[0], 1);
  $na = (int)$na[0];
  $nb = (int)$nb[0];
  if ($na == $nb)
    return 0;
  return ($na < $nb) ? -1 : 1;
}

function get_brother_pages($year) {
  # Returns a list of brother pages in a year.
  $brother_dir = "/mit/tdc/web_scripts/tdc/brothers";
  $nameregex = '/[0-9]+_([A-Za-z ]+).php$/';
  $dir = $brother_dir.'/'.$year;
  $ret = array();
  foreach (scandir($dir, 0) as $page) {
    if (preg_match($nameregex, $page, $params)) {
      $ret[] = $params;
    }
  }
  
  usort($ret, 'cmp');
  return $ret;
}


function get_nav($cur_bro_file) {
  # Prints brother page navigation (HTML generated at the end of the function).
  $filename = basename($cur_bro_file);
  $year_dir = dirname($cur_bro_file);
  $year = (int) end(explode('/', $year_dir));
  /* 
  The return value of get_brother_pages is sorted,  so find $filename 
  in that array and get the previous and next values.
  */
  $prev = null;
  $prev_name = null;
  $found = false;
  $next = null;
  $next_name = null;
  foreach (get_brother_pages($year) as $page) {
    if ($found) {
      $next = $page[0];
      $next_name = $page[1];
      break;
    } elseif ($page[0] == $filename) {
      $found = true;
    } else {
      $prev = $page[0];
      $prev_name = $page[1];
    }
  }
  if (!$found)
    throw new Exception("$filename not found in $year_dir");
    
  if (is_null($prev)) {
    /* Point to the previous year's directory. */
    $prev_pages = get_brother_pages($year - 1);
    if ($prev_pages) {
      $last = end($prev_pages); 
      $prev = '../'.($year - 1).'/'.$last[0];
      $prev_name = $last[1].' ('.($year - 1).')';
    }
  }
  if (is_null($next)) {
    /* Point to the next year's directory. */
    $next_pages = get_brother_pages($year + 1);
    if ($next_pages) {
      $first = $next_pages[0];
      $next = '../'.($year + 1).'/'.$first[0];
      $next_name = $first[1].' ('.($year + 1).')';
    }
  }
    
  /* Generate the html */
  echo '<div id="nav"><div id="prev">';
  if (is_null($prev)) {
    echo '<img id="prev_arrow" class="disabled" src=/tdc/images/functional/prev.png/>';
  } else {
    echo '<a href="'.$prev.'"><img id="prev_arrow" class="enabled" src="/tdc/images/functional/prev.png"/></a>';
  }
  echo '</div><div id="names">';
  if ($prev)
    echo '<div id="nprev">previous:&nbsp;'.$prev_name.'</div>';
  else
    echo '<div id="nprev">Start!</div>';
  if ($next)
    echo '<div id="nnext">next:&nbsp;'.$next_name.'</div>';
  else
    echo '<div id="nnext">End.</div>';
  echo '</div><div id="next">';
  if (is_null($next)) {
    echo '<img id="next_arrow" class="disabled" src=/tdc/images/functional/next.png/>';
  } else {
    echo '<a href="'.$next.'"><img id="next_arrow" class="enabled" src="/tdc/images/functional/next.png"/></a>';
  }
  echo '</div></div>';
}

function print_year($year, $split=null) {
  # Prints <ol> formatted list of the brothers in a year.
  # Splits it into several lists of size $split if $split is specified.
  # Names link to their brother page.
  $ret = array();
  echo '<ol class="bro_list">'."\n";
  $count = 0;
  $list_count = 0;
  foreach (get_brother_pages($year) as $info) {
    $name = $info[1];
    if ($split && $list_count >= $split) { 
      echo '</ol>'."\n".'<ol class="bro_list" start="'.($count+1).'">';
      $list_count = 0;
    }
    echo '<li><a href="/tdc/brothers/'.$year.'/'.$info[0].'">'.$name.'</a></li>'."\n";
    $count += 1;
    $list_count += 1;
  }
  echo '</ol>';
}

?>
