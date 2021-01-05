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
    public static function anotarCookieEnBDD($codigoCookie, $idUsuario): bool
    {
        $pdo = DAO::obtenerPdoConexionBD();
        if ($codigoCookie == "NULL") {
            $codigoCookie = NULL;
        }
        $sqlSentencia = "UPDATE cliente SET codigoCookieCliente=? WHERE idCliente=?";

        $sqlUpdate = $pdo->prepare($sqlSentencia);
        $sqlUpdate->execute([$codigoCookie, $idUsuario]);
        if ($sqlUpdate->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public static function borrarCookieRecordar(array $arrayUsuario)
    {
        // Eliminar el código cookie de nuestra BD.
        $idCliente = $arrayUsuario[0]["idCliente"];
        DAO::anotarCookieEnBDD("NULL", $idCliente);
        // Pedir borrar cookie (setcookie con tiempo time() - negativo...)
        setcookie("identificador", "", time() - 86400);
        setcookie("clave", "", time() - 86400);
    }
    public static function cerrarSesion()
    {
        $arrayUsuario = DAO::obtenerClienteConUsuario((string)$_SESSION["usuarioCliente"]);
        DAO::borrarCookieRecordar($arrayUsuario);
        session_unset();
        session_destroy();
        redireccionar("SessionInicioFormulario.php");
    }
    public static function generarCookieRecordar(array $arrayUsuario)
    {
        // Creamos un código cookie muy complejo (no necesariamente único).
        $codigoCookie = generarCadenaAleatoria(32); // Random...
        $idCliente = $arrayUsuario[0]["idCliente"];
        // actualizar el codigoCookie en la BDD
        DAO::anotarCookieEnBDD($codigoCookie, $idCliente);
        // TODO Para una seguridad óptima convendría anotar en la BD la fecha de caducidad de la cookie y no aceptar ninguna cookie pasada dicha fecha.
        // anotar la cookie en el navegador
        $usuarioCliente = $arrayUsuario[0]["usuarioCliente"];
        $valorCookie = $codigoCookie;
        setcookie("usuarioCliente", $usuarioCliente, time() + 86400);
        setcookie("clave", $valorCookie, time() + 86400);
    }
    public static function marcarSesionComoIniciada($arrayUsuario)
    {
        $_SESSION["idCliente"] = $arrayUsuario[0]["idCliente"];
        $_SESSION["usuarioCliente"] = $arrayUsuario[0]["usuarioCliente"];
        $_SESSION["nombreCliente"] = $arrayUsuario[0]["nombreCliente"];
        $_SESSION["apellidosCliente"] = $arrayUsuario[0]["apellidosCliente"];
        //redireccionar("");
    }

    public static function ejecutarConsultaObtener(string $sql, array $parametros): ?array
    {
        if (!isset(DAO::$pdo)) DAO::$pdo = DAO::obtenerPdoConexionBd();

        $sentencia = DAO::$pdo->prepare($sql);
        $sentencia->execute($parametros);
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }
    public static function ejecutarConsultaActualizar(string $sql, array $parametros): int
    {
        if (!isset(DAO::$pdo)) DAO::$pdo = DAO::obtenerPdoConexionBd();

        $sentencia = DAO::$pdo->prepare($sql);
        $sentencia->execute($parametros);
        return $sentencia->rowCount();
    }

    /*---------- Funciones para Comic ----------*/
    public static function comicEleminarPorId(int $id): bool
    {
        $sql = "DELETE FROM comic WHERE idComic=?";
        $return = DAO::ejecutarConsultaObtener($sql, [$id]);
        if ($return) {
            return true;
        } else {
            return false;
        }
    }
    private static function comicCrearDesdeRs(array $fila): Comic
    {
        return new Comic($fila["idComic"], $fila["tituloComic"], $fila["precioComic"], $fila["cantidadComic"], $fila["portadaComic"], $fila["idCategoria"]);
    }
    public static function comicCrear($titloComic, $precio, $cantidad, $portadaComic, $idCategoria): bool
    {
        $sql = "INSERT INTO comic (tituloComic,precioComic,cantidadComic,portadaComic,idCategoria) VALUES (?,?,?,?,?)";
        $parametros = [$titloComic, $precio, $cantidad, $portadaComic, $idCategoria];
        $datos = DAO::ejecutarConsultaActualizar($sql, $parametros);
        return $datos;
    }
    public static function comicModificar($tituloComic, $precio, $cantidad, $portadaComic, $idCategoria, $idComic): bool
    {
        $sql = "UPDATE comic SET tituloComic=?,precioComic=?,cantidadComic=?,portadaComic=?,idCategoria=? WHERE idComic=?";
        $parametros = [$tituloComic, $precio, $cantidad, $portadaComic, $idCategoria, $idComic];
        return $datosNoModificados = DAO::ejecutarConsultaActualizar($sql, $parametros);
    }
    public static function comicObtenerPorId(int $id): ?Comic
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
        $rs = self::ejecutarConsultaObtener(
            "SELECT nombreCategoria FROM categoria WHERE idCategoria=?",
            [$id]
        );
        return $rs[0]["nombreCategoria"];
    }




    // Funciones para Cliente


    /*--------------------------- FUNCIONES PARA CLIENTE ------------------------------*/
    public static function obtenerClienteConUsuario(string $usuarioCliente): ?array
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $sql = "SELECT * FROM cliente WHERE usuarioCliente='$usuarioCliente'";
        $select = $pdo->prepare($sql);
        $select->execute([]);
        $resultados = $select->fetchAll();
        return $resultados;
    }
    public static function obtenerCliente(string $usuarioCliente, string $emailCliente): ?array
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $sql = "SELECT * FROM cliente WHERE usuarioCliente='$usuarioCliente' OR emailCliente='$emailCliente'";
        $select = $pdo->prepare($sql);
        $select->execute([]);
        $resultados = $select->fetchAll();
        return $resultados;
    }

    public static function guardarImg($usuarioCliente, $foto, $ruta)
    {
        //foto: name del de la foto
        //ruta: ruta temporal
        //usuario: usuario de que vamos a modificar

        $destino = "uploads/$foto";
        move_uploaded_file($ruta, $destino);
        $extension = pathinfo($foto, PATHINFO_EXTENSION);
        $nombreNuevo = "$usuarioCliente" . "." . "$extension";
        rename("uploads/$foto", "uploads/" . "$nombreNuevo");
        
        /*------- Insertar en la BDD ---------*/
        $pdo = DAO::obtenerPdoConexionBD();
        $sqlSentencia = "UPDATE cliente SET fotoDePerfilCliente=? WHERE usuarioCliente=?";
        $sqlUpdate = $pdo->prepare($sqlSentencia);
        $sqlUpdate->execute([$nombreNuevo, $usuarioCliente]);
    }
    public static function crearUsuario(array $informacionUsuario)
    {
        $pdo = DAO::obtenerPdoConexionBD();
        /*CRAGAR LOS DATOS DEL ARRAY*/
        $codigoCookie = (string)NULL;
        $nombreCliente = (string)$informacionUsuario["nombreCliente"];
        $apellidosCliente = (string)$informacionUsuario["apellidosCliente"];
        $usuarioCliente = (string)$informacionUsuario["usuarioCliente"];
        $emailCliente = (string)$informacionUsuario["emailCliente"];
        $contrasennaCliente = (string)$informacionUsuario["contrasennaCliente"];
        $foto = $informacionUsuario["foto"];
        $ruta = $informacionUsuario["ruta"];
        $verificarIdCliente = DAO::obtenerCliente($usuarioCliente, $emailCliente);

        if (!empty($verificarIdCliente)) {
            $_SESSION["txt"] = "¡ERROR! El usuario o el email introducidos ya existen.";
            redireccionar("UsuarioNuevoFormulario.php");
        } else {
            $sqlSentencia = "INSERT INTO cliente (usuarioCliente,emailCliente,contrasennaCliente,
                     codigoCookieCliente,fotoDePerfilCliente,nombreCliente,apellidosCliente) VALUES (?,?,?,?,?,?,?)";
            $sqlInsert = $pdo->prepare($sqlSentencia);
            $sqlInsert->execute([
                $usuarioCliente, $emailCliente, password_hash($contrasennaCliente, PASSWORD_BCRYPT), $codigoCookie, $foto, $nombreCliente, $apellidosCliente
            ]);
            DAO::guardarImg($usuarioCliente, $foto, $ruta);
            if ($sqlInsert->rowCount() == 1) {
                $_SESSION["txt"] = "¡La cuenta se ha creado correctamente! Ya pudes iniciar session.";
                redireccionar("UsuarioNuevoFormulario.php");
            } else {
                $_SESSION["txt"] = "¡ERROR! No se ha podido crear la cuenta, intentalo otra vez.";
                redireccionar("UsuarioNuevoFormulario.php");
            }
        }
    } //FIN FUNCION DE CREAR NUEVO USUARIO
    /*---------- Funciones para Categoría ----------*/

    public static function categoriaEliminarPorId(int $id): bool
    {
        $sql = "DELETE FROM categoria WHERE idCategoria=?";
        $return = DAO::ejecutarConsultaObtener($sql, [$id]);
        if ($return) {
            return true;
        } else {
            return false;
        }
    }

    public static function categoriaCrear($nombreCategoria): bool
    {
        $sql = "INSERT INTO categoria (nombreCategoria) VALUES (?)";
        $parametros = [$nombreCategoria];
        $datos = DAO::ejecutarConsultaActualizar($sql, $parametros);
        return $datos;
    }
    public static function categoriaModificar($nombreCategoria, $idCategoria): bool
    {
        $sql = "UPDATE categoria SET nombreCategoria=? WHERE idCategoria=?";
        $parametros = [$nombreCategoria, $idCategoria];
        return $datosNoModificados = DAO::ejecutarConsultaActualizar($sql, $parametros);
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

    /*---------- Funciones para Pedido----------*/
    public static function pedidoCrearParaCliente($idCliente): bool
    {
        $pdo = DAO::obtenerPdoConexionBd();
        $comprobar = "SELECT * FROM pedido WHERE idCliente = ? AND fechaConfrmacionPedido IS NULL";
        $parametrosComprobar = [$idCliente];


        $sentencia = $pdo->prepare($comprobar);
        $sentencia->execute($parametrosComprobar);
        if ($sentencia->rowCount() == 0) {
            $sql = "INSERT INTO pedido (idCliente) VALUES (?)";
            $parametros = [$idCliente];
            $sentenciaFinal = $pdo->prepare($sql, $parametros);
            return $sentenciaFinal->execute($parametros);
        } else {
            return false;
        }
    }
    public static function pedidoObetenerPorId($idCliente): ?array
    {
        
        $sql = "SELECT * FROM pedido WHERE idCliente = ? AND fechaConfrmacionPedido IS NULL";
        $parametros = [$idCliente];
        $resultado = self::ejecutarConsultaObtener($sql,$parametros);
        return $resultado;
        
    }
    public static function carritoAnadirComic($idComic, $idCliente)
    {
        $pdo = DAO::obtenerPdoConexionBd();
        $rs =  self::pedidoObetenerPorId($idCliente);
        $idPedido = $rs[0]['idPedido'];
        $cantidad = 1;
        $sql = "INSERT INTO comic_pedido (idPedido,idComic,unidades) VALUES (?,?,?)";
        $parametros = [$idPedido,$idComic,$cantidad];
        $sentenciaFinal = $pdo->prepare($sql, $parametros);
        return $sentenciaFinal->execute($parametros);
    }
}// FIN DE LA CLASSE DAO