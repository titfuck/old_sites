<?php
# Helpers for a simple email form.
# REQUIRES mcrypt extension.
error_reporting(E_ALL);
$key = md5('m3nerv4');
$cypher = MCRYPT_RIJNDAEL_256;
$mode = MCRYPT_MODE_ECB;
function print_email_form($name_address_map) {
    global $key, $cypher, $mode;
    ?><form action="email_form.php" method="POST"><?
    $map_str = implodeAssoc(',', $name_address_map);
    $encrypted_map = base64_encode(mcrypt_encrypt($cypher, $key, $map_str, $mode));
    # Drop-down TO selector:
    ?><label for="to">To:</label>
    <select name="to" id="to"><?
    foreach ($name_address_map as $name => $address) {
        echo '<option value="'.$name.'">'.$name.'</option>';
    }
    ?></select><br/>
    <label for="from">From:</label>
    <input type="text" name="from" id="from"/><br/>
    <label for="subject">Subject:</label>
    <input type="text" name="subject" id="subject"/><br/>
    <label for="message">Message:</label>
    <textarea id="message" name="message" cols="40" rows="6"></textarea><br/>
    <input type="hidden" name="map" value="<?print $encrypted_map;?>"/>
    <input type="submit" value="Send"/>
    </form><?
};

if (array_key_exists('map', $_POST)) {
    # Someone's POSTing valid email form data to this script.
    
    $name_address_map = mcrypt_decrypt($cypher, $key, base64_decode($_POST['map']), $mode);
    $name_address_map = explodeAssoc(',', $name_address_map);
    $to = $_POST['to'];
    if (!array_key_exists($to, $name_address_map)) {
        print("Error: No email associated with $to");
        return;
    }
    $to_address = $name_address_map[$to];
    $from = $_POST['from'];
    if (strpos($from, '@') === false) {
        print("Error: Message must be from a valid email address!");
        return;
    }
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    mail($to_address, $subject, $message, "FROM: $from");
    mail($from, "SENT: $subject", "Sent to $to:\r\n".$message, "FROM: $from");
    header('Content-Type: text/html');
?>
<html><head></head><body>
SENT MESSAGE:<br/>
TO: <?print $to;?><br/>
FROM: <?print $from;?><br/>
SUBJECT: <?print $subject;?><br/>
MESSAGE:<br/>
<?print $message;?><br/>
</body></html>
<?
}

# Utility functions:
/**
* @name implodeAssoc($glue,$arr)
* @description makes a string from an assiciative array
* @parameter glue: the string to glue the parts of the array with
* @parameter arr: array to implode
*/
function implodeAssoc($glue,$arr)
{
   $keys=array_keys($arr);
   $values=array_values($arr);

   return(implode($glue,$keys).$glue.implode($glue,$values));
};

/**
* @name explodeAssoc($glue,$arr)
* @description makes an assiciative array from a string
* @parameter glue: the string to glue the parts of the array with
* @parameter arr: array to explode
*/
function explodeAssoc($glue,$str)
{
   $arr=explode($glue,$str);

   $size=count($arr);

   for ($i=0; $i < $size/2; $i++)
       $out[$arr[$i]]=$arr[$i+($size/2)];

   return($out);
}; 
?>
