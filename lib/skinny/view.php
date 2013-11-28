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

class View 
{
	public static function start_include_path( $dir=null ) {
		$dir = (empty($dir)) ? (realpath(dirname(__FILE__)."/../..") ) : $dir;
		set_include_path( $dir.PATH_SEPARATOR.get_include_path() );
	}
	public static function end_include_path() {
		$paths = get_include_path();
		$paths = explode(PATH_SEPARATOR, $paths);
		array_shift($paths);
		$paths = implode(PATH_SEPARATOR, $paths);
		set_include_path( $paths ) ;
	}
	public static function show( $template_name, $params ) {
		echo self::render( $template_name , $params );
	}
	public static function render( $template_name , $params ) {
		self::start_include_path();

		ob_start();
		extract($params);
		include($template_name);
		$str = ob_get_contents();
		ob_end_clean();

		self::end_include_path();
		return $str;
	}
}

