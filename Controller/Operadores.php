<?php
class Operadores extends Controller
{
    public function __construct()
    {
        Auth::noAuth();
        Permisos::getPermisos(OPERADORES);
        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url . "/login");
        }
        //consulta que trae toda la informacion
        $operadores = OperadoresModel::allOperadores();
  


        $this->views->getView($this, "index", [
            'page_name' => "Operadore Vehiculares",
            'function_js' => "Operadores.js",
            'operadores' => to_obj($operadores)
        ]);
    }
    public function nuevo()
    {
        $this->views->getView($this, "nuevo", [
            'page_name' => "Nuevo Operador",
            'function_js' => "Operadores.js",

        ]);
    }
    //Editar
    public function edit($id)
    {
        if (Permisos::read()) {

            $idOper = intval(limpiar($id));

            if ($idOper > 0) {
                $oper = OperadoresModel::editOpera($idOper);
                if (empty($oper)) {
                    Alertas::new('ESTE REGISTRO NO EXISTE', 'warning');
                    header('Location:' . base_url . '/operadores');
                }
                //SI EXISTE EL ID MOSTRAMOS EL REGISTRO EN LA VISTA
                $this->views->getView($this, "edit", [
                    'page_name' => "Editando: " . $oper['nombre'],
                    'function_js' => "Operadores.js",
                    //convertir el arreglo en objetos
                    'oper' => to_obj($oper),
                ]);
            } else {
                header('Location:' . base_url . '/operadores');
            }
            return;
        }
        Alertas::new('No tiene permiso para realizar esta accion', 'warning');
        header('Location:' . base_url . '/operadores');
    }
    // crear nuevo operador
    public function store()
    {
        if (empty($_POST['id'])) {

            if (Permisos::create()) {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    try {
                        // validar
                        $val = new Validations();
                        $fecha = new DateTime();
                        $val->name('nombre')->value(limpiar($_POST['nombre']))->required();
                        $val->name('correo')->value(limpiar($_POST['correo']))->required();
                        $val->name('celular')->value(limpiar($_POST['celular']))->required();
                        $val->name('status')->value(limpiar($_POST['selStatus']))->required();
                        $val->name('txtimagen')->value($_FILES['txtimagen']['name'])?$_FILES['txtimagen']['name']:"";

                        
                        if ($val->isSuccess()) {
                        $fecha = new DateTime();
                        $nombreArchivo = ('$txtimagen'!="")?$fecha->getTimestamp()."_".$_FILES["txtimagen"]["name"]:"imagen.jpg";
                        $tmpImagen = $_FILES["txtimagen"]["tmp_name"];
                        if ($tmpImagen!="") {
                            move_uploaded_file($tmpImagen,"./Imagenes/.$nombreArchivo");
                        }
                            // guardar
                            $data = [
                                'nombre' => limpiar($_POST['nombre']),
                                'correo' => limpiar($_POST['correo']),
                                'celular' => limpiar($_POST['celular']),
                                'status' => limpiar($_POST['selStatus']),
                                'foto' => $nombreArchivo,
                            ];

                            $id = OperadoresModel::guardarOpera($data);
                            Alertas::new(sprintf('El Operador Vehicular %s se ha creado con exito ', $data['nombre']));
                            header('Location:' . base_url . '/operadores');
                        } else {
                            Alertas::new($val->getErrors(), 'danger');
                            header('Location:' . base_url . '/operadores/nuevo');
                        }
                    } catch (PDOException $e) {
                        Alertas::new($e->getMessage(), 'danger');
                        header('Location:' . base_url . '/operadores/nuevo');
                    }
                }
            } else {
                Alertas::new("No tiene permiso para realizar esta accion", 'warning');
                header('Location:' . base_url . '/operadores/nuevo');
            }
        } else {
            // editar/actualizar el rol
            if (Permisos::updater()) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    try {
                        // validar
                        $val = new Validations();
                        $val->name('nombre')->value(limpiar($_POST['nombre']))->required();
                        $val->name('correo')->value(limpiar($_POST['correo']))->required();
                        $val->name('celular')->value(limpiar($_POST['celular']))->required();
                        $val->name('fotografia')->value($_FILES['fotografia']);
                        $val->name('status')->value(limpiar($_POST['selStatus']))->required();
                        if ($val->isSuccess()) {
                            // actualizar
                            $data = [
                                'nombre' => limpiar($_POST['nombre']),
                                'correo' => limpiar($_POST['correo']),
                                'celular' => limpiar($_POST['celular']),
                                'fotografia' => $_FILES['fotografia'],
                                'status' => limpiar($_POST['selStatus']),
                            ];

                            $id = OperadoresModel::actualizarOpera($_POST['id'], $data);
                            Alertas::new(sprintf('El operador placas %s se ha actualizado con exito ', $data['placas']));
                            header('Location:' . base_url . '/operadores');
                        } else {
                            Alertas::new($val->getErrors(), 'danger');
                            header('Location:' . base_url . '/operadores/edit');
                        }
                    } catch (PDOException $e) {
                        Alertas::new($e->getMessage(), 'danger');
                        header('Location:' . base_url . '/operadores/edit');
                    }
                }
            } else {

                Alertas::new("No tiene permiso para ACTUALIZAR esta informacion", 'warning');
                header('Location:' . base_url . '/vehiculos');
            }
        }

        return;
    }
    public function destroy()
    {
        if (Permisos::deleter()) {
            $dataJson = [];
            if (empty($_POST['id'])) {
                $dataJson = ['status' => false, 'msg' => 'No se recibieron los datos'];
            } else {
                $id = intval(limpiar($_POST['id']));
                
                $ide = OperadoresModel::deleteOpera($id);
                $dataJson = ['status' => true, 'msg' => Alertas::new(sprintf('La informacion del Operador %s se ha eliminado correctamente', $_POST['nombre']), 'danger')];
            }
        } else {
            $dataJson = ['status' => false, 'msg' => Alertas::new('No tiene permisos para realizar esta accion', 'danger')];
        }
        echo json_encode($dataJson, JSON_UNESCAPED_UNICODE);
    }
}
