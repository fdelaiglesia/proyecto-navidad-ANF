<?php

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

class Comic extends Dato
{
    use Identificable;
    private string $tituloComic;
    private int $precio;
    private int $cantidad;
    private string $portadaComic;
    private string $idCategoria;
    // TODO: clase comic (no estoy seguro de como poner el idCategoria para relacionarlo con la clase categoria)
    // TODO:
    public function __construct(int $idComic, string $tituloComic, int $precio,
                                int $cantidad, string $portadaComic, Categoria $categoria)
    {
        $this->setId($idComic);
        $this->setTituloComic($tituloComic);
        $this->setPrecio($precio);
        $this->setCantidad($cantidad);
        $this->setPortadaComic($portadaComic);
        //$this->
    }

    /*------------------ Funciones GET de todas la propiedades de Cliente -----------------*/
    public function getTituloComic(): string{return $this->tituloComic;}
    public function getPrecio(): int{return $this->precio;}
    public function getCantidad(): int{return $this->cantidad;}
    public function getPortadaComic(): string{return $this->portadaComic;}

    /*------------------ Funciones SET de todas la propiedades de Cliente -----------------*/
    public function setTituloComic(string $tituloComic): void{$this->tituloComic = $tituloComic;}
    public function setPrecio(int $precio): void{$this->precio = $precio;}
    public function setCantidad(int $cantidad): void{$this->cantidad = $cantidad;}
    public function setPortadaComic(string $portadaComic): void{$this->portadaComic = $portadaComic;}

}