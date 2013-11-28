<?php
/**
* @author  https://github.com/takuya
*
* Copyright (C)  2012-2013  takuya. All rights reserved.
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
$temp = get_include_path();
set_include_path(dirname(__FILE__).PATH_SEPARATOR.$temp);
require ('skinny/app.php');
require ('skinny/view.php');
set_include_path($temp);
