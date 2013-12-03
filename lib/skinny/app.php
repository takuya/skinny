<?php
/**
* @author  https://github.com/takuya
* Copyright (C)  2012-2013 t_m. All rights reserved.
*
* This program is free software; you can redistribute it and/or modify it under
* the terms of the GNU General Public License as published by the Free Software
* Foundation; either version 2 of the License, or (at your option) any later
* version.
* 
* This program is distributed in the hope that it will be useful, but WITHOUT
* ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
* FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
* details.
* 
* You should have received a copy of the GNU General Public License along with
* this program; if not, write to the Free Software Foundation, Inc., 59 Temple
* Place, Suite 330, Boston, MA 02111-1307 USA
*
*/

class App
{
	public function __construct(){
		setlocale(LC_ALL,'ja_JP.UTF-8');
		$this->routing_rules = array();
		$this->routing_rules["GET"] = array();
		$this->routing_rules["POST"] = array();
		$this->routing_rules["404"] = array();
		$this->path = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : "/";
		$this->is_post  = ($_SERVER["REQUEST_METHOD"] == "POST");
		$this->is_get   = ($_SERVER["REQUEST_METHOD"] == "GET");
		$this->set_default_404();
		$this->view = "View";
		$this->templates_path =  realpath(dirname(__FILE__)."/../../templates");
	}
	public function on_post($path, $func_name){
		$this->routing_rules["POST"][$path] = $func_name;
	}
	public function on_get($path, $func_name){
		$this->routing_rules["GET"][$path] = $func_name;
	}
	public function param($name){
		$params = $this->is_post ? $_POST : ($this->is_get ?  $_GET  : $params ) ;
		return !empty( $params[$name] ) ?  $params[$name] : null;
	}
	public function on_404($func_name){
		$this->routing_rules["404"] = $func_name;
	}
	public function set_default_404(){
		function _404($app) {
			header("HTTP/1.0 404 Not Found");
			echo "404 not found";			
		}
		$this->on_404("_404");
	}
	public function get_method_ref($name){
		$class = new ReflectionClass(get_class($this));
		$method = $method = $class->getMethod($name);
		return $method;
	}
	public function run(){
		if(!empty($this->routing_rules[$_SERVER["REQUEST_METHOD"]][$this->path]) ){
			$this->routing_rules[$_SERVER["REQUEST_METHOD"]][$this->path]($this);
			return ;
		}
		$this->show_404();
	}
	public function show_404(){
		return $this->routing_rules["404"]($this);
	}
	public function setView($view_class_name){
		$this->view = $view_class_name;
	}
	public function render($template_name=null, $params=array() ){
		if( is_array($template_name) ||( empty($template_name) && empty($params) ) ) {
			$params = is_array($template_name) ? $template_name: $params ;
			$template_name = "{$this->templates_path}".DIRECTORY_SEPARATOR."{$this->path}.php";
		}else{
			$template_name = "{$this->templates_path}".DIRECTORY_SEPARATOR."{$template_name}";	
		}
		if(!file_exists($template_name)){
			return $this->show_404();
		}
		$class = new ReflectionClass($this->view);
		$b = $class->getMethod("render");
		$ret = $b->invoke($class, $template_name, $params );
		return $ret;
	}
	public function show($template_name=null, $with_params=array()){
		echo $this->render($template_name, $with_params);
	}
}

