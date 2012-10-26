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

//The csengine kernel. Holds all low-level shit
//Any assbags who write in here, ADD GORRAM COMMENTS. I want to know how to use it X_X
// Version tag: 2.0-0

//Includes
require('rc.php'); //Provides csengine_rc_interface();
class csengine_interface {
    //Psudo-Protocols
    CONST CSENGINE_PROTOCOL_FILE=0; //File protocol support
    CONST CSENGINE_PROTOCOL_SYS=1; //System calls
    CONST CSENGINE_PROTOCOL_API=2; //API interface layer
    CONST CSENGINE_PROTOCOL_ENGINE=3; //Engine interface layer

    //Protocols
    CONST CSENGINE_PROTOCOL_IPC=4; //Interprocess communication
    CONST CSENGINE_PROTOCOL_TCP=5; //TCP/IP
    CONST CSENGINE_PROTOCOL_UDP=6; //[cSc] Ill probably never do this

    public function __construct($csengine_input_interface_type, $csengine_input_module, $csengine_input_protocol=4, $csengine_input_version='2.0') { //IPC Protocol(Interprocess Communication) by default
            //Lets turn these into special things
            //Variables
            $this->csengine_kernel_interface = (int)$csengine_input_interface_type;
            $this->csengine_kernel_module = (string)$csengine_input_module;
            $this->csengine_kernel_version = (float)$csengine_input_version;
            $this->csengine_kernel_protocol = (int)$csengine_input_protocol;
            //Allow sys vars to be retrieved
            $this->csengine_rc_system_variables = new csengine_interface(SYS, null);

            //Start up the csengine_log
            $this->csengine_kernel_log = new csengine_log();

            //Code
            switch($this->csengine_kernel_interface) {
                case csengine_kernel_interface::CSENGINE_FILE:
                    fopen($this->csengine_location, 'ab');
                    $this->csengine_kernel_log->csengine_log(NOTICE, "$this->location opened."); //TODO: Add date & time logging
                    break;
                case csengine_kernel_interface::CSENGINE_PROTOCOL_SYS:
                    $this->csengine_rc_system_pipe = new csengine_rc_interface(); //Pop the system interface open
                    $this->csengine_kernel_log->csengine_log(NOTICE, "System interface accessed"); //TODO: Date&time&'user'
                    $this->csengine_rc_system_pipe->csengine_rc_writeValue('active', true);
                    break;
                case csengine_kernel_interface::CSENGINE_PROTOCOL_API:
                    //todo, now just spit out a log error and break
                    $this->csengine_kernel_log->csengine_log(WARNING, "User attempted to access stuff that doesn't exist!");
                    break;
                case csengine_kernel_interface::CSENGINE_PROTOCOL_ENGINE:
                    //todo, now just spit out a log error and break
                    $this->csengine_kernel_log->csengine_log(WARNING, "User attempted to access stuff that doesn't exist!");
                    break;
                case csengine_kernel_interface::CSENGINE_PROTOCOL_IPC:
                    //todo, now just spit out a log error and break
                    $this->csengine_kernel_log->csengine_log(WARNING, "User attempted to access stuff that doesn't exist!");
                    break;
                case csengine_kernel_interface::CSENGINE_PROTOCOL_TCP:
                    //todo, now just spit out a log error and break
                    $this->csengine_kernel_log->csengine_log(WARNING, "User attempted to access stuff that doesn't exist!");
                    break;
            }
    }
    public function csengine_get_uid($csengine_uid_input_type) { //[cSc] [TODO] perhaps private variables instead of identifying them with _
        $this->csengine_uid_type = (int)$csengine_uid_input_type;
        $this->csengine_uid_list = fopen($this->csengine_rc_system_pipe->csengine_rc_retrieveValue('uid_list'), 'rb'); //use the already initialized sysinfo pipe
        while(!$this->csengine_uid_used) { //start up a loop to fish out an unused uid
            $this->csengine_uid++; //increase the id at the start of the loop
            while(!feof($this->csengine_uid_list)) {
                $this->csengine_uid_list = explode('/n', trim(fgets($this->csengine_uid, 4096))); //???
                if($this->csengine_uid_list[0] == $this->csengine_uid) {
                    $this->csengine_uid_used == true; //if its taken, set the var to true
                }
                if(!$this->csengine_uid_list[0] == $this->csengine_uid) {
                    $this->csengine_uid_used == false; //if not, set it to false
                }
            }
            if($this->csengine_uid_used == true) {
                $this->csengine_kernel_log->csengine_log(ERROR, "Couldn't find a proper unique id"); //if its taken and the loop is done, log an die
                die("Cound't Find a proper unique id!");
            } else {
                return $this->csengine_uid; //else return the uid
            }
        }
    }
}
class csengine_log {
    CONST CSENGINE_NORMAL=0;
    CONST CSENGINE_WARNING=1;
    CONST CSENGINE_NOTICE=2;
    CONST CSENGINE_ERROR=3;

    public function __construct($type, $strng) {
        //We only need to use a system information pipe...
        if(!$this->csengine_rc_system_pipe->csengine_rc_retrieveValue('active') == true) {
            $this->csengine_rc_system_pipe = new csengine_interface(SYS, null); //Its not open, pop one
        }
        switch($type) {
            case csengine_log::CSENGINE_NORMAL:
                $this->csengine_csengine_logfile = fopen($this->csengine_rc_system_pipe->csengine_rc_retrieveValue('csengine_log'), 'ab');
                fwrite($this->csengine_logfile, "NORMAL: $strng");
                fclose($this->csengine_logfile);
                break;
            case csengine_log::CSENGINE_WARNING:
                $this->csengine_logfile = fopen($this->csengine_rc_system_pipe->getValue('csengine_logfile'), 'ab');
                fwrite($this->csengine_logfile, "WARNING: $strng");
                fclose($this->csengine_logfile);
                break;
            case csengine_log::CSENGINE_NOTICE:
                $this->csengine_logfile = fopen($this->csengine_rc_system_pipe->getValue('csengine_logfile'), 'ab');
                fwrite($this->csengine_logfile, "NOTICE: $strng");
                fclose($this->csengine_logfile);
                break;
            case csengine_log::CSENGINE_ERROR:
                $this->csengine_logfile = fopen($this->csengine_rc_system_pipe->getValue('csengine_logfile'), 'ab');
                fwrite($this->csengine_logfile, "ERROR: $strng");
                fclose($this->csengine_logfile);
                break;

                return FALSE; //Hopefully if none of these are able to run properly and it does not break as expected, it will return the function as 'false'
        }
    }
}
?>
