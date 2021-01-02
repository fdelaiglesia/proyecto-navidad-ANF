<?php
// TODO: añadir cosas aqui segun necesitamos aqui

require_once "Com/clases.php";
require_once "Com/varios.php";


class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD(): PDO
    {
        $servidor = "localhost";
        $bd = "comicStore";
        $identificador = "root";
        $contrasenna = "";
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }

        return $pdo;
    }

    /*---------- Funciones generales ----------*/
    public static function ejecutarConsultaObtener(string $sql, array $parametros): ?array{
        if (!isset(DAO::$pdo)) DAO::$pdo = DAO::obtenerPdoConexionBd();

        $sentencia=DAO::$pdo->prepare($sql);
        $sentencia->execute($parametros);
        $resultado=$sentencia->fetchAll();
        return $resultado;
    }
    public static function ejecutarConsultaActualizar(string $sql, array $parametros): int {
        if (!isset(DAO::$pdo)) DAO::$pdo = DAO::obtenerPdoConexionBd();

        $sentencia=DAO::$pdo->prepare($sql);
        $sentencia->execute($parametros);
        return $sentencia->rowCoun();
    }
    /*---------- Funciones para Comic ----------*/
    public static function comicEleminarPorId(int $id): bool{
        $sql="DELETE * FROM Comic WHERE idComic=?";
        $return=DAO::ejecutarConsultaObtener($sql,[$id]);
        if($return){
            return true;
        }else{
            return false;
        }
    }
    private static function comicCrearDesdeRs(array $fila): Comic
    {
        return new Comic($fila["idComic"], $fila["tituloComic"], $fila["precio"], $fila["cantidad"], $fila["portadaComic"], $fila["idCategoria"]);
    }

    public static function comicObtenerTodos(): array
    {
        $datos = [];
        $rs = self::ejecutarConsultaObtener(
            "SELECT * FROM comic ORDER BY tituloComic",
            []
        );

        foreach ($rs as $fila) {
            $persona = self::comicCrearDesdeRs($fila);
            array_push($datos, $persona);
        }

        return $datos;
    }

    public static function comicObtenerCategoria(int $id): string
    {
        $rs= self::ejecutarConsultaObtener(
            "SELECT nombreCategoria FROM categoria WHERE idCategoria=?",
            [$id]
        );
        return $rs[0]["nombreCategoria"];
    }


    }