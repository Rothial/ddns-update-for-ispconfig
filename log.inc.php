<?php

class log {
    private $file; 
    
	function __construct($name) {
	$processUser = posix_getpwuid(posix_geteuid()); // Move log files elsewhere
	$logpath = strstr($processUser['dir'], '.', true);
        $this->file = "".$logpath."/private/log_".str_replace('.', '_', $name).".txt" ;
       
    }
	
    function debug($log) {
        $log = date('Y-m-d H:i:s')." ".$log."\n"; 
        $maj = fopen($this->file,"a+"); // Open the file in read/write mode
        fseek($maj, 0, SEEK_END);
        fputs($maj, $log);            // We write in the file
        fclose($maj);    
    }
    
    function clean() {
        $maj = fopen($this->file,"a+"); // Open the file in read/write mode
        ftruncate($maj,0);            // Erase the contents of a file
        fclose($maj);  
    }
 
}
?>
