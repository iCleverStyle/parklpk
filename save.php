<?php
	//include("db.php");
                      $id= filter_input (INPUT_POST ,  'id' , FILTER_SANITIZE_STRING );
                      $id=explode('_', $id);
                      $itemid=mysql_real_escape_string($id[0]);
                      $itempole=mysql_real_escape_string($id[1]);
                      $content = $_POST['content']; //get posted data
	//$content = mysql_real_escape_string($content);	//escape string	
	//$sql = "UPDATE content SET $itempole = '$content' WHERE element_id = '$itemid' ";
	if ($content) 
                     {
                       print $content;
                     }
                     else print '№1';
  ?>
