<?php
namespace Clases;
use PDO;
use PDOException;
class Conexion{
    protected static $conexion;

    public function __construct(){
        if(self::$conexion == null){
            self::crearConexion();
        }
    }
    public static function crearConexion(){
        //1.-leemos el archivo de configuracion 
        $opciones=parse_ini_file('../.config');
        $mibase=$opciones["bbdd"];
        $miusuario=$opciones["usuario"];
        $mipass=$opciones["pass"];
        $mihost=$opciones["host"];
        //2.- creo el dns(descriptor de servicio) co estos parametros
        $dns="mysql:host=$mihost;dbname=$mibase;charset=utf8mb4";
        //3.- creo la conexion 
        try{
            self::$conexion=new PDO($dns, $miusuario, $mipass);
            //lo siguiente solo para depurar errores
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        }catch(PDOException $ex){
            die("Error al conectar a la BBDD, mensaje: ".$ex->getMessage());
        }
    }
}