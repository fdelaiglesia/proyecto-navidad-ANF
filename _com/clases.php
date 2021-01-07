<?php
// TODO: añadir cosas aqui segun necesitamos aqui
abstract class Dato
{
}

trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

/*----------------- Clase Categoria -------------------*/
class Categoria extends Dato
{
    use Identificable;

    private string $nombreCategoria;

    public function __construct(int $id, string $nombreCategoria)
    {
        $this->setId($id);
        $this->setNombreCategoria($nombreCategoria);
    }

    public function getNombreCategoria(): string
    {
        return $this->nombreCategoria;
    }

    public function setNombreCategoria(string $nombre)
    {
        $this->nombreCategoria = $nombre;
    }


}

/*----------------- Clase Cliente -------------------*/
class Cliente extends Dato
{
    use Identificable;
    private string $usuario;
    private string $email;
    private string $contrasenna;
    private string $codigoCookie;
    private string $fotoDePerfil;
    private string $nombreCliente;
    private string  $apellidos;

    public function __construct(int $idCliente, string $usuario, string $email, string $contrasenna
        , string $codigoCookie, string $fotoDePerfil, string $nombreCliente, string $apellidos)
    {
        $this->setId($idCliente);
        $this->setUsuario($usuario);
        $this->setEmail($email);
        $this->setContrasenna($contrasenna);
        $this->setCodigoCookie($codigoCookie);
        $this->setFotoDePerfil($fotoDePerfil);
        $this->setNombreCliente($nombreCliente);
        $this->setApellidos($apellidos);
    }

    /*------------------ Funciones GET de todas la propiedades de Cliente -----------------*/
    public function getUsuario(): string{return $this->usuario;}
    public function getEmail(): string{return $this->email;}
    public function getContrasenna(): string{return $this->contrasenna;}
    public function getCodigoCookie(): string{return $this->codigoCookie;}
    public function getFotoDePerfil(): string{return $this->fotoDePerfil;}
    public function getNombreCliente(): string{return $this->nombreCliente;}
    public function getApellidos(): string{return $this->apellidos;}

    /*------------------ Funciones SET de todas la propiedades de Cliente -----------------*/
    public function setUsuario(string $usuario): void{$this->usuario = $usuario;}
    public function setEmail(string $email): void{$this->email = $email;}
    public function setContrasenna(string $contrasenna): void{$this->contrasenna = $contrasenna;}
    public function setCodigoCookie(string $codigoCookie): void{$this->codigoCookie = $codigoCookie;}
    public function setFotoDePerfil(string $fotoDePerfil): void{$this->fotoDePerfil = $fotoDePerfil;}
    public function setNombreCliente(string $nombreCliente): void{$this->nombreCliente = $nombreCliente;}
    public function setApellidos(string $apellidos): void{$this->apellidos = $apellidos;}
}

/*----------------- Clase Comic -------------------*/
class Comic extends Dato
{
    use Identificable;
    private string $tituloComic;
    private int $precio;
    private int $cantidad;
    private  $portadaComic;
    private int $idCategoriaDeComic;
//TODO: Portada comic da errores cuando es NULL(Siempre por ahora) no sé solucionarlo ni con ?string, la solucion por ahora es quitarle el tipo
    public function __construct(int $idComic, string $tituloComic, int $precio,
                                int $cantidad,  $portadaComic, int $idCategoriaDeComic)
    {
        $this->setId($idComic);
        $this->setTituloComic($tituloComic);
        $this->setPrecioComic($precio);
        $this->setCantidadComic($cantidad);
        $this->setPortadaComic($portadaComic);
        $this->setIdCategoriaDeComic($idCategoriaDeComic);
    }

    /*------------------ Funciones GET de todas la propiedades de Cliente -----------------*/
    public function getTituloComic(): string{return $this->tituloComic;}
    public function getPrecioComic(): int{return $this->precio;}
    public function getCantidadComic(): int{return $this->cantidad;}
    public function getPortadaComic(): string{return $this->portadaComic;}
    public function getIdCategoriaDeComic(): int{return $this->idCategoriaDeComic;}
    /*------------------ Funciones SET de todas la propiedades de Cliente -----------------*/
    public function setTituloComic(string $tituloComic): void{$this->tituloComic = $tituloComic;}
    public function setPrecioComic(int $precio): void{$this->precio = $precio;}
    public function setCantidadComic(int $cantidad): void{$this->cantidad = $cantidad;}
    public function setPortadaComic( $portadaComic): void{$this->portadaComic = $portadaComic;}
    public function setIdCategoriaDeComic(int $idCategoriaDeComic): void
    {
        $this->idCategoriaDeComic = $idCategoriaDeComic;
    }
}

/*----------------- Clase Carrito -------------------*/
class Carrito extends Dato
{
    use Identificable;
    private int $idPedido;
    private int $idCliente;
    private int $unidades;

    public function __construct(int $idPedido, int $idComic, int $unidades)
    {
        $this->setIdPedido($idPedido);
        $this->setIdComic($idComic);
        $this->setUnidades($unidades);
    }

    public function getIdComic(): string{return $this->idComic;}
    public function getIdPedido(): string{return $this->idPedido;}
    public function getUnidades(): string{return $this->unidades;}
    public function setIdComic(int $idComic): void {$this->idComic = $idComic;}
    public function setIdPedido(int $idPedido): void {$this->idPedido = $idPedido;}
    public function setUnidades(int $unidades): void {$this->unidades= $unidades;}
    
}

/*----------------- Clase Pedido -------------------*/
class Pedido extends Carrito{
    private string $direccionEnvio;
    private string $fechaConfirmacion;

    public function __construct(int $idPedido,int $idCliente, string $direccionEnvio, string $fechaConfirmacion)
    {
        $this->setIdPedidoP($idPedido);
        $this->setIdClienteP($idCliente);
        $this->setDireccionEnvio($direccionEnvio);
        $this->setDireccionEnvio($fechaConfirmacion);
    }

    /*------------------ Funciones GET de todas la propiedades de Pedido -----------------*/
    public function getIdPedido(): string{return $this->idPedido;}
    public function getIdCliente(): string{return $this->idCliente;}
    public function getDireccionEnvio(): string{return $this->direccionEnvio;}
    public function getFechaConfirmacion(): string{return $this->fechaConfirmacion;}

    /*------------------ Funciones SET de todas la propiedades de Cliente -----------------*/
    public function setIdPedidoP(string $idPedido): void{$this->idpedido = $idPedido;}
    public function setIdClienteP(string $idCliente): void{$this->getIdCliente = $idCliente;}
    public function setDireccionEnvio(string $direccionEnvio): void{$this->direccionEnvio = $direccionEnvio;}
    public function setFechaConfirmacion(string $fechaConfirmacion): void{$this->fechaConfirmacion = $fechaConfirmacion;}
}
