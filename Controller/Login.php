<?php
class Login extends Controller
{
  public function __construct()
  {
    if (isset($_SESSION['login'])) {
      header('Location:' . base_url . '/perfil');
    }
    parent::__construct();
  }

  public function index()
  {
    $data['title'] = 'Ingreso al sistema';
    $data['function_js'] = 'Login.js';
    $this->views->getView($this, 'index', $data);
  }

  public function ingresar()
  {
    $arrJson = [];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $val = new Validations();

      $val->name('email')->value(limpiar($_POST['email']))->pattern('email')->required();
      $val->name('password')->value(limpiar($_POST['password']))->min(5)->max(20)->pattern('alphanum')->required();

      // si todo esta bien se logea
      if ($val->isSuccess()) {
        //logueo
        $usuario = LoginModel::login(limpiar($_POST['email']), hash("sha256", limpiar($_POST['password'])));
        //si existen los valoresen la base se guarda en la variable la informacion completa


        if (empty($usuario)) { //si viene vacia la variable
          $arrJson = ['error' => 'Error no existe el usuario'];
        } else {
          // crear nuestras sessiones
          $_SESSION['iduser'] = $usuario['id_usuario'];
          $_SESSION['nombre'] = $usuario['nombre'];
          $_SESSION['email'] = $usuario['email'];
          $_SESSION['sucursal'] = $usuario['id_sucursal'];


          $_SESSION['login'] = true;
          
          
          
          Auth::sessionUser($_SESSION['iduser']);
          $arrJson = ['msg' => 'Bienvenido a SCDS'];
        }
      } else {
        $arrJson = ['error' => $val->getErrors()];
      }
    }
    echo json_encode($arrJson, JSON_UNESCAPED_UNICODE);
  }
}
