<?php
/* This file is part of CSEngine.

CSEngine is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

CSEngine is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with CSEngine.  If not, see <http://www.gnu.org/licenses/>. */
class si {
    private $vi = array(
        "logfile" => "data/logs/system.log",
        "udil" => "data/system/udil.list",
        "active" => false,
        "hostname" => "myhost",
        "datadir" => "./data"
    );
    public function __construct() {
        require('kernel.php'); //logging
        $this->vi = (array)$vi;
        $this->sysLog = new logger(); //We need log access
    }
    public function retrieveValue($value) {
        if($value == true || $value == false || $value == True || $value == False || $value == FALSE || $value == TRUE) {
            $this->value = (bool)$value;
        }
        if($value == "" || $value == '') {
            $this->value = (string)$value;
        } else {
            $this->value = (string)$value;
        }
        return $vi["$this->value"];
    }
}
?>
