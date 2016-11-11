<?php
$myarray=array(1 => array(1.2,1.2,1.3),2 =>array(2.1,2.2,2.3),3,4,5);
//echo "<pre>".print_r($myarray)."</pre>";
echo "Normal count (array element): " . sizeof($myarray)."<br>";
echo "Recursive count( array elements and their sub array elements): " . sizeof($myarray,1);
 