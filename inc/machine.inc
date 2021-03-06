<?php
/**
  * machine.inc
  *
  * Manage machine information for a 'ticket'
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

class Machine extends TCenterDataObject
{
	protected function loadObject($m_id)
	{
		$sql = "SELECT * FROM machine WHERE m_id = '$m_id'";

		if ($this->db->query($sql)->num_rows() != 1)
			throw new TCenterException("Machine Information is Bogus");

		$row = $this->db->fetch_assoc();
		
		foreach ($row as $k=>$v)
		{
			$this->objInfo[$k] = $v;
		}
	}
}
