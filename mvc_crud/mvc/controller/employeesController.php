<?php
class EmployeesController{
    public $usernameErr;
    public $passwordErr;
    private $mysqliConnector;
    private $mysqlConnection;
    private $conectar;
    private $Connection;
    private  $checked=false;
    public function __construct() {
		require_once  __DIR__ . "/../core/mysqliConnector.php";
        require_once  __DIR__ . "/../model/employee.php";
        require_once  __DIR__ . "/../model/security.php";
        // $this->conectar=new Conectar();
        // $this->Connection=$this->conectar->Connection();
        $this->mysqliConnector = new MysqliConnector();
        $this->mysqliConnection = $this->mysqliConnector->Connection();
    }
   /**
    * Ejecuta la acción correspondiente.
    *
    */
    public function run($accion){
        switch($accion)
        {   
            
            case "login" :
                $this->login();
                break;
            case "index" :
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
                    $this->index();
                }else{
                    $this->login();
                }
                break;
            case "check" :
                $this->check();
                break;
            case "alta" :
                $this->crear();
                break;
            case "detalle" :
                $this->detalle();
                break;
            case "actualizar" :
                $this->actualizar();
                break;
            default:
                $this->login();
                break;
        }
    }

    public function check(){
        if(empty($_POST["username"])){
            header("Location:index.php? Usererror=Username is required");
            exit();
        }
        elseif(empty($_POST["password"])){

            header("Location:index.php? error=Password is required");
            exit();
        }
        else{
            if($this->checked==false){ 
                $security=new Security($this->mysqliConnection);
                $result=$security->getByUsername($_POST["username"]);
                if(!empty($result)){
                    if($result['password'] == $_POST["password"]){
                        $this->checked=true;
                        $_SESSION['username'] = $result['username'];
                        header("Location:index.php?action=index");
                        //$this->index();
                    }
                    else{
                        $this->view("login",array("error"=>"Incorrect Password"));          
                    }
                }else{
                    $this->view("login",array("error"=>"Incorrect Username")); 
                }
                
            }
            else{
                $this->index();
            } 
        }

        $this->view("login",array());
    }

    public function login(){
        $this->view("login",array());
    }

   /**
    * Loads the employees home page with the list of
    * employees getting from the model.
    *
    */
    public function index(){
        //We create the employee object
        $employee=new Employee($this->mysqliConnection);
        //We get all the employees
        $employees=$employee->getAll();
        //We load the index view and pass values to it
        $this->view("index",array(
            "employees"=>$employees,
            "titulo" => "PHP MVC"
        ));
    }
    /**
    * Loads the employees home page with the list of
     * employees getting from the model.
    *
    */
    public function detalle(){
        //We load the model
        $modelo = new Employee($this->mysqliConnection);
        //We recover the employee from the BBDD
        $employee = $modelo->getById($_GET["id"]);
        $finalData = $employee->fetch_assoc();
        //We load the detail view and pass values to it
        $this->view("detalle",array(
            "employee"=>$finalData,
            "titulo" => "Detalle Employee"
        ));
    }
   /**
    * Create a new employee from the POST parameters
     * and reload the index.php.
    *
    */
    public function crear(){
        if(isset($_POST["Name"])){
            //Creamos un usuario
            $employee=new Employee($this->mysqliConnection);
            $employee->setName($_POST["Name"]);
            $employee->setSurname($_POST["Surname"]);
            $employee->setEmail($_POST["email"]);
            $employee->setphone($_POST["phone"]);
            $save=$employee->save();
        }
        header('Location: index.php');
    }
   /**
    * Update employee from POST parameters
     * and reload the index.php.
    *
    */
    public function actualizar(){
        if(isset($_POST["id"])){
            //We create a user
            $employee=new Employee($this->mysqliConnection);
            $employee->setId($_POST["id"]);
            $employee->setName($_POST["Name"]);
            $employee->setSurname($_POST["Surname"]);
            $employee->setEmail($_POST["email"]);
            $employee->setphone($_POST["phone"]);
            $save=$employee->update();
        }
        header('Location: index.php');
    }
   /**
    * Create the view that we pass to it with the indicated data.
    *
    */
    public function view($vista,$datos){
        $data = $datos;
        require_once  __DIR__ . "/../view/" . $vista . "View.php";
    }
}
?>