<?php

require( '.mit.php' );

$PLEDGE_YEAR_START = 2008;
$PLEDGE_YEAR_END = 2010;
$CLASS_YEAR_START = 2008;
$CLASS_YEAR_END = 2010;

function render_brother_list( $sql_result )
{
	while( $binfo = mysql_fetch_assoc( $sql_result ) )
	{
		$html_bits[] = '<strong>Pledge no. ' . $binfo['b_pledgeno'] . '</strong> &mdash; ' . $binfo['b_name'];
	}

	return implode( $html_bits, '<br />' );
}

$page_title = 'Our Brotherhood';
require( '.header.php' );
?>
By pledge year:
<?
for( $i = $PLEDGE_YEAR_END; $i >= $PLEDGE_YEAR_START; $i-- )
  $py_links[] = '<a href="?m=p&y=' . $i . '">' . $i . '</a>';
echo implode( $py_links, ' - ' ) . '<br />';
?>
By class year:
<?
for( $i = $CLASS_YEAR_END; $i >= $CLASS_YEAR_START; $i-- )
  $cy_links[] = '<a href="?m=c&y=' . $i . '">' . $i . '</a>';
echo implode( $cy_links, ' - ' ) . '<br />';
?>
<br />
<?
if( 'p' == $_REQUEST['m'] )
{
	$year = $_REQUEST['y'];
	if( !is_numeric( $year ) || $year < $PLEDGE_YEAR_START || $year > $PLEDGE_YEAR_END )
		echo 'Invalid input year.';
	else
	{
		if( !($results = mysql_query( 'SELECT * FROM `brothers` WHERE `b_pledgeyear` = ' . $year . ' ORDER BY `b_pledgeno` ASC' )) ) die( 'Error with query.' );
		echo '<strong>Pledge Class of ' . $year . '</strong><br />';
		while( $binfo = mysql_fetch_assoc( $results ) )
        		$html_bits[] = '<strong>Pledge no. ' . $binfo['b_pledgeno'] . '</strong> &mdash; <a href="?m=d&y=' . $year . '&' . 'n=' . $binfo['b_pledgeno'] . '">' . $binfo['b_name'] . '</a>';
        	echo implode( $html_bits, '<br />' );
		echo '<br /><br /><em>If a pledge number is not listed, the corresponding pledge is no longer affiliated with ' . $TD_TDC . '.</em><br />';
	}
}
else if( 'c' == $_REQUEST['m'] )
{
        $year = $_REQUEST['y'];
        if( !is_numeric( $year ) || $year < $CLASS_YEAR_START || $year > $CLASS_YEAR_END )
                echo 'Invalid input year.';
        else
        {
                if( !($results = mysql_query( 'SELECT * FROM `brothers` WHERE `b_classyear` = ' . $year . ' ORDER BY `b_pledgeyear` ASC, `b_pledgeno` ASC' )) ) die( 'Error with query.' );
                echo '<strong>MIT Class of ' . $year . '</strong><br />';
                while( $binfo = mysql_fetch_assoc( $results ) )
                        $html_bits[] = '<strong>Pledge class ' . $binfo['b_pledgeyear'] . ' no. ' . $binfo['b_pledgeno'] . '</strong> &mdash; <a href="?m=d&y=' . $binfo['b_pledgeyear'] . '&' . 'n=' . $binfo['b_pledgeno'] . '">' . $binfo['b_name'] . '</a>';
                echo implode( $html_bits, '<br />' );
        }
}
else if( 'd' == $_REQUEST['m'] )
{
	$year = $_REQUEST['y'];
	$no = $_REQUEST['n'];
       	if( !is_numeric( $year ) || !is_numeric( $no ) || $year < $CLASS_YEAR_START || $year > $CLASS_YEAR_END )
                echo 'Invalid input year or number.';
        else
        {
		if( !($results = mysql_query( 'SELECT * FROM `brothers` WHERE `b_pledgeyear` = ' . $year . ' AND `b_pledgeno` = ' . $no )) ) die( 'Error with query.' );
		if( !($binfo = mysql_fetch_assoc( $results )) )
			echo 'No such year/number combination found.';
		else
		{
			echo '<strong>' . $binfo['b_name'] . '</strong><br />';
			echo 'Class year: ' . $binfo['b_classyear'] . '<br />';
			echo 'Pledge year: ' . $binfo['b_pledgeyear'] . '<br />';
			echo 'Pledge no.: ' . $binfo['b_pledgeno'] . '<br />';
			if( 'TRUE' != $binfo['b_hidepledgename'] )
				echo 'Pledge name: &quot;' . $binfo['b_pledgename'] . '&quot;<br />';
			echo 'Hometown: ' . $binfo['b_hometown'] . '<br />';
			if( '' != $binfo['b_major1'] )
			{
				echo 'Major: Course ' . $binfo['b_major1'] . ' &ndash; ' . $major[$binfo['b_major1']];
				if( '' != $binfo['b_major2'] )
					echo '<em> and</em> Course ' . $binfo['b_major2'] . ' &ndash; ' . $major[$binfo['b_major2']];
				echo '<br />';
			}
                        if( '' != $binfo['b_minor1'] )
                        {
                                echo 'Minor: Course ' . $binfo['b_minor1'] . ' &ndash; ' . $major[$binfo['b_minor1']];
                                if( '' != $binfo['b_minor2'] )
                                        echo '<em> and</em> Course ' . $binfo['b_minor2'] . ' &ndash; ' . $major[$binfo['b_minor2']];
                                echo '<br />';
                        }
			if( '' != $binfo['b_othered'] )
			{
				echo 'Other educational focus: ' . $major[$binfo['b_othered']] . '<br />';
			}
			echo '<br /> ' . $binfo['b_blurb'];
		}
	}  
}
else
{ ?>
Random brother to go here.
<? }
?>
<br />
<?php require( '.footer.php' ); ?>
