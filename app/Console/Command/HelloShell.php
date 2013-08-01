<?php
	class HelloShell extends AppShell {
	    public function main() {
	        $this->out('Hello world.');
	    }

	    public function sendEmail(){
	    	parent::sendEmail();
	    	$this->out("A");
	    }
	}