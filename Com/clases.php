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
        $this->setNombre($nombreCliente);
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
    private string $portadaComic;
    private string $idCategoriaDeComic;

    public function __construct(int $idComic, string $tituloComic, int $precio,
                                int $cantidad, string $portadaComic, Categoria $categoria)
    {
        $this->setId($idComic);
        $this->setTituloComic($tituloComic);
        $this->setPrecio($precio);
        $this->setCantidad($cantidad);
        $this->setPortadaComic($portadaComic);
        $this->setIdCategoriaDeComic($categoria);
    }

    /*------------------ Funciones GET de todas la propiedades de Cliente -----------------*/
    public function getTituloComic(): string{return $this->tituloComic;}
    public function getPrecio(): int{return $this->precio;}
    public function getCantidad(): int{return $this->cantidad;}
    public function getPortadaComic(): string{return $this->portadaComic;}
    public function getIdCategoriaDeComic(): string{return $this->idCategoriaDeComic;}
    /*------------------ Funciones SET de todas la propiedades de Cliente -----------------*/
    public function setTituloComic(string $tituloComic): void{$this->tituloComic = $tituloComic;}
    public function setPrecio(int $precio): void{$this->precio = $precio;}
    public function setCantidad(int $cantidad): void{$this->cantidad = $cantidad;}
    public function setPortadaComic(string $portadaComic): void{$this->portadaComic = $portadaComic;}
    public function setIdCategoriaDeComic(Categoria $categoria): void
    {
        $this->idCategoriaDeComic = $categoria->getId();
    }
}

/*----------------- Clase Carrito -------------------*/
class Carrito extends Dato
{
    use Identificable;
    private string $idCliente;

    public function __construct(Cliente $cliente)
    {

    }

    public function getIdCliente(): string{return $this->idCliente;}
    public function setIdCliente(Cliente $cliente): void {$this->idCliente = $cliente->getId();}
}

/*----------------- Clase Pedido -------------------*/
class Pedido extends Carrito{
    private string $direccionEnvio;
    private string $fechaConfirmacion;

    public function __construct(Cliente $cliente, string $direccionEnvio, string $fechaConfirmacion)
    {
        parent::__construct($cliente);
        $this->setDireccionEnvio($direccionEnvio);
        $this->setDireccionEnvio($fechaConfirmacion);
    }

    /*------------------ Funciones GET de todas la propiedades de Pedido -----------------*/
    public function getDireccionEnvio(): string{return $this->direccionEnvio;}
    public function getFechaConfirmacion(): string{return $this->fechaConfirmacion;}

    /*------------------ Funciones SET de todas la propiedades de Cliente -----------------*/
    public function setDireccionEnvio(string $direccionEnvio): void{$this->direccionEnvio = $direccionEnvio;}
    public function setFechaConfirmacion(string $fechaConfirmacion): void{$this->fechaConfirmacion = $fechaConfirmacion;}
}




