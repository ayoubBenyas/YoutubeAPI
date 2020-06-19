<?php

namespace App\Console;

class Command{
    /**
     * The commands provided by your application.
     *
     * @var array
     */
    protected $verb, $type, $name;

    public function __construct($cmd){
        $this->verb = strtolower($cmd[0]);
        $this->type = strtolower($cmd[1]);
        $this->name = strtolower($cmd[2]);
    }

    public static function capture( $input){
        $commande = explode(':',$input[1]);
        return new self($commande);
    }

    public function handle(){
        $file = new File( $this->type, $this->name );
        $methode = $this->verb;
        $file->$methode();
    }

}
