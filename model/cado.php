<?php

    class cado extends PDO {

    private $type = 'pgsql';
    private $host = 'localhost';
    private $db = 'central';
    private $user = 'postgres';
    private $pass = '1107';

    public function __construct() {
        try {
            parent::__construct($this->type . ':host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
        }
    }

    public function conectar() {
        $this->descriptor =  pg_connect("host='".$this->host."' dbname='".$this->db."' user='".$this->user."' password='".$this->pass."'") or die("error al conetar a la base de datos");
        return $this->descriptor;

    }
    
}

?>
