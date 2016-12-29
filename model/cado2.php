<?php
$ggTipoBD=3;
$ggTipoCon=1;
function umill($valor){
	global $ggTipoBD;
	if($ggTipoBD==1){
		$valor = utf8_encode($valor);
		return $valor;
	}elseif($ggTipoBD==2){
		return utf8_encode($valor);
	}else{
		return $valor;
	}
}

function umillmain($valor){
	global $ggTipoBD;
	if($ggTipoBD==1){
		$valor = utf8_encode($valor);
		return $valor;
	}elseif($ggTipoBD==2){
		return utf8_encode($valor);
	}else{
		return utf8_decode($valor);
	}
}

function conver($valor){
	global $ggTipoBD;
	if($ggTipoBD==1){
		$valor = utf8_encode($valor);
		return $valor;
	}elseif($ggTipoBD==2){
		return utf8_encode($valor);
	}else{
		return utf8_encode($valor);
	}
}

require_once('pdo/PDO.class.php');

//Clase para acceso a datos
class clsAccesoDatos{
	//Servidor de Base de Datos
	private $gServidor = "localhost";
	//Nombre de Base de Datos
	private $gBaseDatos = "central";
	//Tipo de Base Datos
	private $gTipoBD = 3; //1=SQLSERVER, 2=MYSQL, 3=POSTGRESQL
	public $gTipoConex = 1; //1=PDO, 2 = PDOSICA
	private $gFB;

	// Constructor de la clase
	function __construct($user='', $pass='', $cnx = NULL){
		global $ggTipoBD;
		$this->gTipoBD=$ggTipoBD;
		if($this->gTipoBD==1){
			$this->gServidor = "localhost";
			$user='root';
			$pass='root';
		}
		if($this->gTipoBD==2){
			$this->gServidor = "localhost";
			$user='root';
			$pass='root';
		}
		if($this->gTipoBD==3){
			$this->gServidor = "localhost";
			$user='postgres';//sica
			$pass='1107';//sicaweb2013
		}
		// Crea una Conexion SQLSERVER 2000
		//echo "Antes de COncetar";
		try {
    		if($cnx){
    			$this->gCnx = $cnx;
    		}else{
    			if($this->gTipoBD==1){
    				$this->gCnx = new PDO("mssql:host=".$this->gServidor.";dbname=".$this->gBaseDatos,$user,$pass);
    			}
    			if($this->gTipoBD==2){
    				$this->gCnx = new PDO("mysql:host=".$this->gServidor.";port=3306;dbname=".$this->gBaseDatos,$user,$pass);
    			}
    			if($this->gTipoBD==3){
    				if($this->gTipoConex==1){
    					$this->gCnx = new PDO("pgsql:host=".$this->gServidor.";port=5432;dbname=".$this->gBaseDatos,$user,$pass);
    				}else{
    					echo "Antes de Post";
    					$this->gCnx = new PDOSICA("pgsql:host=".$this->gServidor.";port=5432;dbname=".$this->gBaseDatos,$user,$pass);
    					echo $this->gCnx;
    					echo "Inicia::....".$this->gCnx->errorInfo();
    				}
    			}
    		}
		} catch (PDOException $e) {
			echo "Error:\n" . $e->getMessage();
		}
	}

	// Destructor de la clase
	function __destruct(){
		//Cierra la Conexion BD
		try{
			unset($this->gCnx);
		} catch (PDOException $e) {
			return "Error:\n" . $e->getMessage();
		}
	}

	function getCnx(){
		return $this->gCnx;
    }

	function conectarFB($appId, $secret){
		$this->gFB = new Facebook(array(
		  'appId'  => $appId,
		  'secret' => $secret,
		));
		return $this->gFB;
	}

	function getTipoBD(){
		return $this->gTipoBD;
	}

	function obtenerDataSP($sql){
		if($this->gTipoBD>1){
			$sql = substr($sql,8,strlen($sql)-8);
			$valor = strpos($sql,' ');
			return  $this->obtenerDataSQL("SELECT * FROM ".substr($sql,0,$valor)."(".substr($sql,$valor, strlen($sql)-$valor).")");
		}else{
			$this->gStmt = $this->gCnx->prepare($sql);
			$this->gStmt->execute();
			if($this->gStmt->errorCode()=="00000"){
				$this->gError = $this->gStmt->errorInfo();
				return $this->gStmt;
			}else{
				$this->gError = $this->gStmt->errorInfo();
				return $this->gError[2];
			}
		}
 	}

	function obtenerDataSQL($sql, $mill=true){
		if($this->gTipoBD==2){
			$sql = $this->millSQL($sql);
		}
		if($this->gTipoBD==3){
			if($mill){
				$sql = $this->millSQL($sql);
			}
			$sql = str_replace('LIKE','LIKE',$sql);
			$sql = str_replace('like','like',$sql);
		}
		//echo $sql;
		if($this->gTipoConex==1){
			//$this->gCnx->query("SET DATESTYLE TO EUROPEAN, SQL;");
      //$this->gCnx->query("set client_encoding to 'utf8';");
			$this->gCnx->query("SET NAMES 'utf8'");
			$rst = $this->gCnx->query($sql);
			if($this->gCnx->errorCode()=="00000"){
				return $rst;
			}else{
				$this->gError = $this->gCnx->errorInfo();
				return $sql.$this->gError[2];
			}
		}else{
			$rst = $this->gCnx->prepare("SET DATESTYLE TO EUROPEAN, SQL;");
			$rst->execute();
			$rst = $this->gCnx->prepare($sql);
			if($rst->execute()){
				//echo "BIEN";
				return $rst;
			}else{
				//echo "MAL";
				$this->gError = $this->gCnx->errorInfo();
				return $sql.$this->gError[2];
			}
		}
 	}

	function ejecutarSP($sql){
		if($this->gTipoBD==2){
			$sql = substr($sql,8,strlen($sql)-8);
			$valor = strpos($sql,' ');
			return  $this->ejecutarSQL("CALL ".substr($sql,0,$valor)."(".substr($sql,$valor, strlen($sql)-$valor).")");
		}elseif($this->gTipoBD==3){
			$sql = substr($sql,8,strlen($sql)-8);
			$valor = strpos($sql,' ');
			return  $this->ejecutarSQL("SELECT ".substr($sql,0,$valor)."(".substr($sql,$valor, strlen($sql)-$valor).")");
		}else{
			$this->gStmt = $this->gCnx->prepare($sql);
			$this->gStmt->execute();
			if($this->gStmt->errorCode()=="00000"){
				$this->gMsg = "Guardado correctamente";
				return 0;
			}else{
				$this->gError = $sql.$this->gStmt->errorInfo();
				return 1;
			}
		}
 	}

	function ejecutarSQL($sql){
		if($this->gTipoConex==1){
						//$this->gCnx->query("SET DATESTYLE TO EUROPEAN, SQL;");
            //$this->gCnx->query("set client_encoding to 'utf8'");
						$this->gCnx->query("SET NAMES 'utf8'");
			$rst = $this->gCnx->query($sql);
			if($this->gCnx->errorCode()=="00000"){
				return 0;
			}else{
				$this->gError = $this->gCnx->errorInfo();
				return 1;
			}
		}else{
			$rst = $this->gCnx->prepare("SET DATESTYLE TO EUROPEAN, SQL;");
			$rst->execute();
			$rst = $this->gCnx->prepare($sql);
			//print_r( $rst);
			$rst->execute();
			if($rst->errorCode()=="SQLER"){
				$this->gError = $rst->errorInfo();
				return 1;
			}else{
				//$this->gMsg = $rst->errorCode();
				return 0;
			}
		}
 	}

	function iniciarTransaccion(){
		if($this->gTipoBD==2){
   		$this->ejecutarSQL("START TRANSACTION;");
		}else{
		$this->ejecutarSQL("BEGIN TRANSACTION");
		}
 	}

	function abortarTransaccion(){
		if($this->gTipoBD==2){
   		$this->ejecutarSQL("ROLLBACK;");
		}else{
		$this->ejecutarSQL("ROLLBACK TRANSACTION");
		}

 	}

	function finalizarTransaccion(){
		if($this->gTipoBD==2){
   		$this->ejecutarSQL("COMMIT;");
		}else{
		$this->ejecutarSQL("COMMIT TRANSACTION");
		}

 	}

	function ControlaTransaccion(){
		$rst=$this->obtenerDataSQL("SELECT @@ERROR AS ERROR");
		$dato=$rst->fetchObject();
		if($dato->ERROR=='0'){
			$this->finalizarTransaccion();
			return "Guardado correctamente";
		}else{
			$this->abortarTransaccion();
			return "Fallo Transacción";
		}
 	}

	function mill($valor){
		if($this->gTipoBD==1){
			$valor = utf8_decode($valor);
			$valor = str_replace("\\\\" ,"\\", $valor);
			$valor = str_replace("\\\"" ,"\"", $valor);
			$valor = str_replace("\'" ,"''", $valor);
			return $valor;
		}elseif($this->gTipoBD==2){
			return $valor;
		}else{
			return $valor;
		}
 	}

	function millSQL($sql){
		$data = explode("'",$sql);
		$con=count($data);
		for($i=0;$i<=$con;$i++){
			if($i%2==0){
				$data[$i] = strtolower($data[$i]);
			}else{
                if(isset($data[$i]))
				    $data[$i] = $data[$i];
                else
                    $data[$i] = "";
			}
		}
		$sql = implode("'",$data);
		$sql = substr($sql,0,strlen($sql)-1);
		if($this->gTipoBD==2){
			$cadena1="";
			$cadena2="";
			$pos_ini = 0;
			$pos_fin = strpos($sql,"obtenertabla");
			while($pos_fin>0){
				$cadena1 = substr($sql,0,$pos_fin-1);
				$cadena2 = substr($sql,$pos_fin);
				$pos = strpos($cadena2,")");
				$convertir= substr($cadena2,0,$pos+1);
				$cadena2 = substr($cadena2,$pos+1);
				$sql = $cadena1.$this->obtenerTablaSql($convertir).$cadena2;
				$pos_fin = strpos($sql,"obtenertabla");
			}
		}
		return $sql;
	}

	function millSQLRPT($sql){
		$data = explode("'",$sql);
		$con=count($data);
		for($i=0;$i<=$con;$i++){
			if($i%2==0){
				$data[$i] = strtolower($data[$i]);
			}else{
				//$data[$i] = ($data[$i]?$data[$i]:' ');
			}
		}
		$sql = implode("'",$data);
		$sql = substr($sql,0,strlen($sql)-1);
		if($this->gTipoBD==2){
			$cadena1="";
			$cadena2="";
			$pos_ini = 0;
			$pos_fin = strpos($sql,"obtenertabla");
			while($pos_fin>0){
				$cadena1 = substr($sql,0,$pos_fin-1);
				$cadena2 = substr($sql,$pos_fin);
				$pos = strpos($cadena2,")");
				$convertir= substr($cadena2,0,$pos+1);
				$cadena2 = substr($cadena2,$pos+1);
				$sql = $cadena1.$this->obtenerTablaSql($convertir).$cadena2;
				$pos_fin = strpos($sql,"obtenertabla");
			}

		}
		return $sql;
	}
}
?>
