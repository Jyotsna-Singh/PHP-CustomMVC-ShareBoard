<?php
class Bootstrap{
	private $controller;
	private $action;
	private $request;
	
	
	//store the URL values on object creation
	public function __construct($request){
		$this->request = $request;
		//Check if correct controller is given like register, or if blank then redirect to home page
		if($this->request['controller'] == ""){
			$this->controller = 'home';
		} else {
			$this->controller = $this->request['controller'];
		}
		//Check if correct action is given like user, or if blank then redirect to home page
		if($this->request['action'] == ""){
			$this->action = 'index';
		} else {
			$this->action = $this->request['action'];
		}
		
	}
	
	//establish the requested controller as an object
	public function createController(){
		//does the class exist?
		if(class_exists($this->controller)){
					$parents = class_parents($this->controller);
					//does the class extend the controller class?
					if(in_array("Controller", $parents)){
						//does the class contain the requested method?
								if(method_exists($this->controller, $this->action)){
									return new $this->controller($this->action, $this->request);
								} else {
									//Method Does Not exist
									echo '<h1>Method does not exist</h1>';
									return;
								}
					}else {
						//Base controller not found
							echo '<h1>Base controller does not exist</h1>';
							return;
					}
		} else{
			//Controller class does not exist
					echo '<h1>Controller class does not exist</h1>';
					return;
		}
	}
	
}