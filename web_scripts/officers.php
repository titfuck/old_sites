<?php

function make_officer_table( $arr )
{
	$res = '<table class="officertable">';
	$linenum = -1;

	foreach( $arr as $line )
	{
		if( '' != $line[0] )
			++$linenum;

		$res .= '<tr class="otrow' . ( $linenum % 2 ) . '"><td class="otcol0">' . $line[0] . '</td><td>' . ( '' == $line[0] ? '<em>and</em>' : '' ) . '</td>';
		if( '' == $line[3] )
			$res .= '<td><em>Elections pending.</em></td></tr>';
		else
			$res .= '<td>' . bro_link( $line[1], $line[2] ) . $line[3] . '</a></td></tr>';
	}

	return $res . '</table>';
}

$page_title = 'Officers';
require( '.header.php' );
?>
<h3>Undergraduate Officers</h3>

<?php
// The format we have used here is 'title', pledge_year, pledge_no, 'name'.
// If the position is unfilled, leave name empty ('').
// If there are two people in a position, leave the 'title' field empty
// for the second person.
$undergrad[] = array( 'President', 2009, 6, 'Samuel Phillips' );
$undergrad[] = array( 'House Manager', 2010, 11, 'Daniel Perez' );
$undergrad[] = array( '', 2011, 6, 'Rocco Policarpo' );
$undergrad[] = array( 'Recording Secretary', 2011, 5, 'Francisco Saldana' );
$undergrad[] = array( 'Corresponding Secretary', 2011, 7, 'Javier Garcia' );
$undergrad[] = array( 'Herald', 2010, 3, 'Christopher Compean' );
$undergrad[] = array( 'Sargeant-at-Arms', 2009, 1, 'Alberto Mena' );
$undergrad[] = array( 'Senior Executive', 2009, 4, 'Emanuel Borja' );
$undergrad[] = array( 'Junior Executive', 2010, 3, 'Christopher Compean' );
$undergrad[] = array( 'Treasurer', 2010, 7, 'Shuyi "James" Chen' );
$undergrad[] = array( 'Rush Chair', 2010, 14, 'Kevin Kelley' );
$undergrad[] = array( '', 2010, 12, 'Joseph Diaz' );
$undergrad[] = array( 'Pledge Trainer', 2010, 8, 'Gaston de Zarraga' );
$undergrad[] = array( 'Steward', 2010, 10, 'Elias Cole' );
$undergrad[] = array( 'Historian', 2010, 7, 'Shuyi "James" Chen' );
$undergrad[] = array( 'Social Chair', 2011, 4, 'Benjamin Williams' );
$undergrad[] = array( '', 2010, 3, 'Christopher Compean' );
$undergrad[] = array( 'Risk Manager', 2011, -1, 'Ben Williams' );
$undergrad[] = array( 'Network Geek', 2010, 14, 'Kevin Kelley' );
$undergrad[] = array( '', 2010, 5, 'John Marrero' );
$undergrad[] = array( 'Librarian', 2009, 3, 'Harry Huxford' );
$undergrad[] = array( 'Community Service Chair', 2011, 7, 'Javier Garcia' );
$undergrad[] = array( 'Academic Chair', 2011, 7, 'Javier Garcia' );
$undergrad[] = array( 'Firetruck', 2011, 1, 'Robert Bustamante' );

echo make_officer_table( $undergrad );
?>

<h3>Alumni Officers</h3>

<?php require( '.footer.php' ); ?>
