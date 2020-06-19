<?php

namespace App\Console;

class File
{
    /**
     * The commands provided by your application.
     *
     * @var array
     */
    protected  $type, $name;

    public function __construct($type, $name){
        $this->type = $type;
        $this->name = $name;
    }

    public function make(){
        $base_dir = dirname(dirname(__DIR__));
        $file_struct = include("$base_dir/config/file.php");
        $file = fopen($base_dir.$file_struct[$this->type]['path']."/$this->name.php","w");
        fwrite($file,"<?php

namespace ".$file_struct[$this->type]['namespace'].";

class $this->name extends ".$file_struct[$this->type]['baseClass']." {

    public function __construct(){
        //
    }

}");
        echo $file_struct[$this->type]['baseClass']." '$this->name' has been created";
        fclose($file);
    }

    public function delete(){
        $base_dir = dirname(dirname(__DIR__));
        $file_struct = include("$base_dir/config/file.php");
        try {
            unlink($base_dir.$file_struct[$this->type]['path']."/$this->name.php");
            echo $file_struct[$this->type]['baseClass']." '$this->name' has been deleted";
        } catch (\Exception $th) {
            echo $file_struct[$this->type]['baseClass']." '$this->name' cannot be deleted due to an error";
        }
    }
}
