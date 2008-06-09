<?php
//The csengine kernel. Holds all low-level shit
//Any assbags who write in here, ADD GORRAM COMMENTS. I want to know how to use it X_X
// Version tag: 2.0-0
class interface {
    //Psudo-Protocols
    CONST FILE=0; //File protocol support
    CONST SYS=1; //System calls
    CONST API=2; //API interface layer
    CONST ENGINE=3; //Engine interface layer

    //Protocols
    CONST IPC=4; //Interprocess communication
    CONST TCP=5; //TCP/IP
    CONST UDP=6; //[cSc] Ill probably never do this

    public function __construct($ifaceType, $location, $protocol=4, $version='2.0') { //IPC Protocol(Interprocess Communication)
            //Lets turn these into special things
            //Variables
            $this->interface = (int)$ifaceType;
            $this->location = (string)$location;
            $this->version = (float)$version;
            $this->proto = (int)$protocol;
            //Start up the logger
            $this->ipLog = new logger();

            //Code
            switch($this->interface) {
                case interface::FILE:
                    fopen($this->location, 'ab');
                    $this->iplog->logger(MINOR, "$this->location opened."); //TODO: Add date & time logging
                    break;
                case interface::SYS:
                    //todo, now just spit out a log error and break
                    $this->ipLog->logger(WARNING, "User attempted to access stuff that doesn't exist!");
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
}
?>
