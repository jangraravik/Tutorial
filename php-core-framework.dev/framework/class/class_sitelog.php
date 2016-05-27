<?php 

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('You cannot directly access this file'); };

class Log {
	
		private $path = '/sitelogs/';
	
	public function __construct() {
		//date_default_timezone_set('Europe/Amsterdam');	 /* if not set in config file */
		$this->path  = dirname(__FILE__)  . $this->path;	
	}
	
	public function write($message) {
		$date = new DateTime();
		$log = $this->path . $date->format('Y-m-d').".txt";

		if(is_dir($this->path)) {
			if(!file_exists($log)) {
				$fh  = fopen($log, 'a+') or die("Fatal Error !");
				$logcontent = "LogTime: " . $date->format('H:i:s')."\r\nLogText: " . $message ."\r\n";
				fwrite($fh, $logcontent);
				fclose($fh);
			}
			else {
				$this->edit($log,$date, $message);
			}
		}
		else {
			  if(mkdir($this->path,0777) === true) 
			  {
				 $this->write($message);  
			  }	
		}
	 }
		private function edit($log,$date,$message) {
		$logcontent = "LogTime: " . $date->format('H:i:s')."\r\nLogText: " . $message ."\r\n\r\n";			
		$logcontent = $logcontent . file_get_contents($log);
		file_put_contents($log, $logcontent);
		}
}