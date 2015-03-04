<?php $page_id="officers"; $page_title="Officers"; require('top.php'); ?>

<h1>TDC Officers</h1>
<table>
<tr><th>Position</th><th>Name</th></tr>
<tr><td>President</td><td>Christopher Compean</td></tr>
<tr><td>Senior Executive</td><td>Daniel Perez</td></tr>
<tr><td>Junior Executive</td><td>Javier Garcia</td></tr>
<tr><td>Risk Manager</td><td>Ryan Rosario</td></tr>
<tr><td>Philanthropy Chair</td><td>Morris Vanegas</td></tr>
<tr><td>Academic Chair</td><td>Morris Vanegas</td></tr>
<tr><td>Treasurer</td><td>Armand Mignot</td></tr>
<tr><td>House Manager</td><td>Javier Garcia</td></tr>
<tr><td>Pledge Trainer</td><td>Joe Diaz</td></tr>
<tr><td>Recording Secretary</td><td>Justin Breucop</td></tr>
<tr><td>Correspondence Secretary</td><td>Daniel Perez</td></tr>
<tr><td>Rush Chair</td><td>Ryan Rosario</td></tr>
<tr><td>Social Chairs</td><td>Michael Munoz and Ben Williams</td></tr>
<tr><td>Herald</td><td>Morris Vanegas</td></tr>
<tr><td>Steward</td><td>Francisco Saldana</td></tr>
<tr><td>Netgeek</td><td>Francisco Saldana</td></tr>
<tr><td>Librarian</td><td>Armand Mignot</td></tr>
<tr><td>Historian</td><td>Sebastian Velez</td></tr>
</table>
<?php 
?><div id="contact_frm"><h2>Contact Us:</h2><?
# Officer Contact Form
# This avoids exposing email addresses to the web.
$officer_emails = array(
    'President' => 'tdc-president@mit.edu',
    'Senior Executive' => 'tdc-senior-exec@mit.edu',
    'Junior Executive' => 'tdc-junior-exec@mit.edu',
    'Risk Manager' => 'tdc-risk-manager@mit.edu',
    'Philanthropy Chair' => 'tdc-philanthropy-chair@mit.edu',
    'Academic Chair' => 'tdc-academic-chair@mit.edu',
    'Treasurer' => 'tdc-treasurer@mit.edu',
    'House Manager' => 'tdc-house-manager@mit.edu',
    'Pledge Trainer' => 'tdc-pledge-trainer@mit.edu',
    'Recording Secretary' => 'jdbreucop@gmail.com',
    'Rush Chair' => 'tdc-rush-chair@mit.edu',
    'Social Chairs' => 'tdc-social-chairs@mit.edu',
    'Herald' => 'mvanegas@mit.edu',
    'Steward' => 'tdc-steward@mit.edu',
    'Netgeek' => 'tdc-net-geek@mit.edu',
    'Librarian' => 'amignot@mit.edu',
    'Historian' => 'sebvel66@mit.edu',
);
require_once('email_form.php');
print_email_form($officer_emails);

?>
</div>
<?php require('footer.php'); ?>
