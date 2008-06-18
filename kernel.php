<?php
//The csengine kernel. Holds all low-level shit
//Any assbags who write in here, ADD GORRAM COMMENTS. I want to know how to use it X_X
// Version tag: 2.0-0
class interface {
    //Includes
    require('rc.conf'); //Provides si();
    //Psudo-Protocols
    CONST FILE=0; //File protocol support
    CONST SYS=1; //System calls
    CONST API=2; //API interface layer
    CONST ENGINE=3; //Engine interface layer

    //Protocols
    CONST IPC=4; //Interprocess communication
    CONST TCP=5; //TCP/IP
    CONST UDP=6; //[cSc] Ill probably never do this

    public function __construct($ifaceType, $location, $protocol=4, $version='2.0') { //IPC Protocol(Interprocess Communication) by default
            //Lets turn these into special things
            //Variables
            $this->interface = (int)$ifaceType;
            $this->location = (string)$location;
            $this->version = (float)$version;
            $this->proto = (int)$protocol;
            //Allow sys vars to be retrieved
            $this->svi = new interface(SYS, null);

            //Start up the logger
            $this->ipLog = new logger();

            //Code
            switch($this->interface) {
                case interface::FILE:
                    fopen($this->location, 'ab');
                    $this->iplog->logger(NOTICE, "$this->location opened."); //TODO: Add date & time logging
                    break;
                case interface::SYS:
                    $this->sysInterface = new si(); //Pop the system interface open
                    $this->ipLog->logger(NOTICE, "System interface accessed"); //TODO: Date&time&'user'
                    $this->sysInterface->writeValue('active', true);
                    break;
                case interface::API:
                    //todo, now just spit out a log error and break
                    $this->ipLog->logger(WARNING, "User attempted to access stuff that doesn't exist!");
                    break;
                case interface::ENGINE:
                    //todo, now just spit out a log error and break
                    $this->ipLog->logger(WARNING, "User attempted to access stuff that doesn't exist!");
                    break;
                case interface::IPC:
                    //todo, now just spit out a log error and break
                    $this->ipLog->logger(WARNING, "User attempted to access stuff that doesn't exist!");
                    break;
                case interface::TCP:
                    //todo, now just spit out a log error and break
                    $this->ipLog->logger(WARNING, "User attempted to access stuff that doesn't exist!");
                    break;
            }
    }
    public function getUniqueID($type) {
        $this->type = (int)$type;
        $this->uidList = fopen($this->svi->retrieveValue('udil'), 'rb'); //use the already initialized sysinfo pipe
        while(!$this->uuidTaken) { //start up a loop to fish out an unused uid
            $this->uid++; //increase the id at the start of the loop
            while(!feof($this->uuidList)) {
                $this->uuidList = explode('/n', trim(fgets($this->uidList, 4096))); //???
                if($this->uuidList[0] == $this->uid) {
                    $this->uidTaken == true; //if its taken, set the var to true
                }
                if(!$this->uuidList[0] == $this->uid) {
                    $this->uidTaken == false; //if not, set it to false
                }
            }
            if($this->uidTaken == true) {
                $this->ipLog->logger(ERROR, "Couldn't find a proper unique id"); //if its taken and the loop is done, log an die
                die("Cound't Find a proper unique id!");
            } else {
                return $this->uid; //else return the uid
            }
        }
    }
}
class logger {
    CONST NORMAL=0;
    CONST WARNING=1;
    CONST NOTICE=2;
    CONST ERROR=3;

    public function __construct($type, $strng) {
        //We only need to use a system information pipe...
        if(!$this->sysInterface->retrieveValue('active') == true) {
            $this->svi = new interface(SYS, null); //Its not open, pop one
        }
        switch($type) {
            case logger::NORMAL:
                $this->logfile = fopen($this->svi->getValue('logfile'), 'ab');
                fwrite($this->logfile, "NORMAL: $strng");
                fclose($this->logfile);
                break;
            case logger::WARNING:
                $this->logfile = fopen($this->svi->getValue('logfile'), 'ab');
                fwrite($this->logfile, "WARNING: $strng");
                fclose($this->logfile);
                break;
            case logger::NOTICE:
                $this->logfile = fopen($this->svi->getValue('logfile'), 'ab');
                fwrite($this->logfile, "NOTICE: $strng");
                fclose($this->logfile);
                break;
            case logger::ERROR:
                $this->logfile = fopen($this->svi->getValue('logfile'), 'ab');
                fwrite($this->logfile, "ERROR: $strng");
                fclose($this->logfile);
                break;
        }
    }
}
?>
