<?php
    namespace Clases;
    require '../vendor/autoload.php';
    require "../clases/Users.php";
    use Faker\Factory;
    use Clases\Users;

    Class Datos{
        public $faker;

        public function __construct($tabla,$cantidad){
            $this->faker=Factory::create('es_ES');
            switch($tabla){
                case "users":
                    $this->crearUsuarios($cantidad);
                    break;
                case "tags";
                    $this->crearTags($cantidad);
                    break;
            }
        }
        public function crearUsuarios($n){
            //creamos usuario admin
            $usuario=new Users();
            //borro todos los anteriores
            $usuario->borrarTodo();
            $usuario->setNombre("Francisco");
            $usuario->setApellidos("Barquier Martinez");
            $usuario->setUsername("admin");
            $usuario->setMail("admin@mail.com");
            $pass=hash("sha256", "secreto0");
            $usuario->setPass("$pass");
            $usuario->create();

            //creamos el resto de usuarios
            for($i=0;$i<=$n;$i++){
                $usuario->setNombre($this->faker->firstName());
                $usuario->setApellidos($this->faker->lastName(). " ".$this->faker->lastName());
                $usuario->setUsername($this->faker->unique()->userName);
                $usuario->setMail($this->faker->unique()->email());
                $usuario->setPass($this->faker->sha256);
                $usuario->create();
            }
            $usuario=null;
        }
        public function crearTags($n){

        }
    }