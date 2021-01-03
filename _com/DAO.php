<?php
// TODO: añadir cosas aqui segun necesitamos aqui

require_once "_com/clases.php";
require_once "_com/varios.php";


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
        return $sentencia->rowCount();
    }
    /*---------- Funciones para Comic ----------*/
    public static function comicEleminarPorId(int $id): bool{
        $sql="DELETE FROM comic WHERE idComic=?";
        $return=DAO::ejecutarConsultaObtener($sql,[$id]);
        if($return){
            return true;
        }else{
            return false;
        }
    }
    private static function comicCrearDesdeRs(array $fila): Comic
    {
        return new Comic($fila["idComic"], $fila["tituloComic"], $fila["precioComic"], $fila["cantidadComic"], $fila["portadaComic"], $fila["idCategoria"]);
    }
   
    public static function comicObtenerPorId(int $id): ? Comic
    {
        $rs = self::ejecutarConsultaObtener(
            "SELECT * FROM Comic WHERE idComic=?",
            [$id]
        );
        if ($rs) return self::comicCrearDesdeRs($rs[0]);
        else return null;
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




// Funciones para Cliente


/*--------------------------- FUNCIONES PARA CLIENTE ------------------------------*/
    public static function obtenerCliente(string $usuarioCliente, string $emailCliente): ?array
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $sql="SELECT * FROM cliente WHERE usuarioCliente='$usuarioCliente' OR emailCliente='$emailCliente'";
        $select= $pdo->prepare($sql);
        $select->execute([]);
        $resultados= $select->fetchAll();
        return $resultados;
    }

    public static function guardarImg($usuarioCliente,$foto,$ruta){
        //foto: name del de la foto
        // ruta: ruta temporal
        // usuario: usuario de que vamos a modificar

        $destino= "FotosDePerfil/".$foto;
        copy($ruta, $destino);
        $extension=pathinfo($foto,PATHINFO_EXTENSION);
        $nombreNuevo="$usuarioCliente"."."."$extension";
        rename("FotosDePerfil/$foto","FotosDePerfil/"."$nombreNuevo");
        /*------- Insertar en la BDD ---------*/
        $pdo=DAO::obtenerPdoConexionBD();
        $sqlSentencia="UPDATE cliente SET fotoDePerfilCliente=? WHERE idCliente=?";
        $sqlUpdate=$pdo->prepare($sqlSentencia);
        $sqlUpdate->execute([$nombreNuevo,$usuarioCliente]);
    }
    public static function crearUsuario(array $informacionUsuario)
    {
        $pdo=DAO::obtenerPdoConexionBD();
        /*CRAGAR LOS DATOS DEL ARRAY*/
        $codigoCookie=(string)$informacionUsuario["codigoCookieCliente"];
        $nombreCliente=(string)$informacionUsuario["nombreCliente"];
        $apellidosCliente=(string)$informacionUsuario["apellidosCliente"];
        $usuarioCliente=(string)$informacionUsuario["usuarioCliente"];
        $emailCliente=(string)$informacionUsuario["emailCliente"];
        $foto="eyy";
       // $ruta=$informacionUsuario["ruta"];
        $verificarIdCliente=DAO::obtenerCliente($usuarioCliente,$emailCliente);

        if(!empty($verificarIdCliente)){
            $_SESSION["txt"]="¡ERROR! El usuario introducido ya existe.";
            redireccionar("UsuarioNuevoFormulario.php");
        }else{
            $sqlSentencia="INSERT INTO cliente (usuarioCliente,emailCliente,contrasennaCliente,
                     codigoCookieCliente,fotoDePerfilCliente,nombreCliente,apellidosCliente) VALUES (?,?,?,?,?,?,?)";
            $sqlInsert= $pdo->prepare($sqlSentencia);
            $sqlInsert->execute([$usuarioCliente,$emailCliente,password_hash($usuarioCliente,PASSWORD_BCRYPT)
                ,$codigoCookie,$foto,$nombreCliente,$apellidosCliente]);
          //  guardarImg($usuarioCliente,$foto,$ruta);
            if($sqlInsert->rowCount()==1){
                $_SESSION["txt"]="¡La cuenta se ha creado correctamente! Ya pudes iniciar session.";
                redireccionar("UsuarioNuevoFormulario.php");
            }else{
                $_SESSION["txt"]="¡ERROR! No se ha podido crear la cuenta, intentalo otra vez.";
                redireccionar("UsuarioNuevoFormulario.php");
            }}}//FIN FUNCION DE CREAR NUEVO USUARIO
        /*---------- Funciones para Categoría ----------*/
   
    public static function categoriaEliminar(int $id)
    {
        self::ejecutarConsultaActualizar(
            "DELETE FROM categoria WHERE idCategoria=?;",
            [$id]
        );
    }
    
    public static function categoriaCrear(string $nombre)
    {
        self::ejecutarConsultaActualizar(
            "INSERT INTO categoria (nombreCategoria) VALUES (?)",
            [$nombre]
        );
    }
    private static function categoriaCrearDesdeRs(array $fila): Categoria
    {
        return new Categoria($fila["idCategoria"], $fila["nombreCategoria"]);
    }
  
    public static function categoriaObtenerPorId(int $id): ?Categoria
    {
        $rs = self::ejecutarConsultaObtener(
            "SELECT * FROM categoria WHERE idCategoria=?",
            [$id]
        );
        if ($rs) return self::categoriaCrearDesdeRs($rs[0]);
        else return null;
    }
    public static function categoriaActualizar($id, $nombre)
    {
        self::ejecutarConsultaActualizar(
            "UPDATE categoria SET nombreCategoria=? WHERE idCategoria=?",
            [$nombre, $id]
        );
    }
    public static function categoriaObtenerTodos(): array
    {
        $datos = [];

        $rs = self::ejecutarConsultaObtener(
            "SELECT * FROM categoria ORDER BY nombreCategoria",
            []
        );

        foreach ($rs as $fila) {
            $categoria = self::categoriaCrearDesdeRs($fila);
            array_push($datos, $categoria);
        }

        return $datos;
    }

    
}// FIN DE LA CLASSE DAO