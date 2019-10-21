<?php




if ($mj->_response_code == 200)
   echo "success - email sent";
else
   echo "error - ".$mj->_response_code;
?>