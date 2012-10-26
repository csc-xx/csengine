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

//Includes
require('kernel.php'); //logging
class csengine_rc_interface {
    private $csengine_value_info = array(
        "csengine_logfile" => "data/logs/system.log",
        "uid_list" => "data/system/uid.list",
        "active" => false,
        "hostname" => "myhost",
        "datadir" => "./data"
    );
    public function __construct() {
        $this->csengine_rc_value_array = (array)$csengine_value_info;
        $this->csengine_rc_log = new logger(); //We need log access
    }
    public function csengine_rc_retrieveValue($csengine_rc_value) {
        if($csengine_rc_value == true || $csengine_rc_value == false || $csengine_rc_value == True || $csengine_rc_value == False || $csengine_rc_value == FALSE || $csengine_rc_value == TRUE) {
            $this->csengine_rc_value = (bool)$csengine_rc_value;
        }
        if($csengine_rc_value == "" || $csengine_rc_value == '') {
            $this->csengine_rc_value = (string)$csengine_rc_value;
        } else {
            $this->csengine_rc_value = (string)$csengine_rc_value;
        }
        return $csengine_value_array["$this->csengine_rc_value"];
    }
}
?>
