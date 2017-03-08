<?php

// Print to console

function cprint($str) {
   static $debug_2014=-1;

   if ($debug_2014===-1) {
       if (!empty($GLOBALS["_SERVER"]["DEBUG_2014"])) { $debug_2014=1; }
       else { $debug_2014=0; }
   }
   if ($debug_2014===1) { echo $str,"\n"; }
}
?>