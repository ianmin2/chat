<?php

	class minify{
	
		public $file_types;
		public $minify_path;
		public $curr_path;
				
		public function __construct(){
			$curr_path = getcwd();	
		}
				
		function minify($download=false, $file_types=array('js','txt'), $minify_path='minify' ){
			
			$this->file_types 	= $file_types;
			$this->minify_path 	= $minify_path;
			
			@mkdir($this->minify_path);
			$files = array();
			
			foreach($file_types as $file_type){
				$files[] = glob("*.".$file_type);
			}
			
			foreach($files as $file){
				
				foreach($file as $filename){
				
					$filepath = $this->curr_path.$filename;
					
					  $minifile = $this->minify_path."/".$filename;
					
					@unlink(str_replace("\\","/",$minifile));
					
					$string = file_get_contents(str_replace("\\","/",$filepath));
					$string = preg_replace('/\s+/','',$string);
					$string = str_replace('<?php','<?php ',$string);
					file_put_contents(str_replace("\\","/",$minifile),$string);
					
				}
				
			}
			
			//print_r($file);
			die;
					
		}
		
		
	
	}

?>