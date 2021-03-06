<?
/**
  * sticker.php
  *
  * generate a label
  *
  * TCenter 3 - Ticket Management
  * Copyright (C) 2007-2008		Rochester Institute of Technology
  *
  * This program is free software: you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation, either version 2 of the License, or
  * (at your option) any later version.
  *
  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.
  *
  * You should have received a copy of the GNU General Public License
  * along with this program.  If not, see <http://www.gnu.org/licenses/>.
  *
  * @author	David Walker	(azrail@csh.rit.edu)
  */

$font_loc="./arialbd.ttf";

header ("Content-type: image/png");
$handle = ImageCreate (170, 60) or die ("Cannot Create image");
$bg_color = ImageColorAllocate ($handle, 255, 255, 255);
$txt_color = ImageColorAllocate ($handle, 0, 0, 0);
ImageString ($handle, 6, 30, 25, $_REQUEST['ticket'], $txt_color);
ImagePng ($handle); 
?>
