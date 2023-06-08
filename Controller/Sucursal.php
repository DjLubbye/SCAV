<?php
class Sucursal extends Controller
{
    public function __construct()
    {
        Auth::noAuth();
        Permisos::getPermisos(SUCURSAL);
        parent::__construct();
    }

    public function index()
    {
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url . "/login");
        }
        $arrJson = [];
        $sucursal = SucursalModel::allSucursales();

        $this->views->getView($this, "index", [
            'page_name' => "Informacion de Sucursales",
            'function_js' => "Sucursal.js",
            'sucursal' => to_obj($sucursal)
        ]);
       
    }
    public function nuevo()
    {
        $this->views->getView($this, "nuevo", [
            'page_name' => "Agregar una nueva sucursal",
            'function_js' => "Sucursal.js",

        ]);
    }
    //Editar
    public function edit($id)
    {
        if (Permisos::read()) {

            $idSuc = intval(limpiar($id));

            if ($idSuc > 0) {
                $suc = SucursalModel::editSucursal($idSuc);
                if (empty($suc)) {
                    Alertas::new('ESTE REGISTRO NO EXISTE', 'warning');
                    header('Location:' . base_url . '/sucursal');
                }
                //SI EXISTE EL ID MOSTRAMOS EL REGISTRO EN LA VISTA
                $this->views->getView($this, "edit", [
                    'page_name' => "Editando Sucursal " . $suc['nombre'],
                    'function_js' => "Sucursal.js",
                    //convertir el arreglo en objetos
                    'sucursal' => to_obj($suc),
                ]);
            } else {
                header('Location:' . base_url . '/sucursal');
            }
            return;
        }
        Alertas::new('No tiene permiso para realizar esta accion', 'warning');
        header('Location:' . base_url . '/sucursal');
    }
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
                        $val->name('direccion')->value(limpiar($_POST['direccion']))->required();
                        $val->name('tipo')->value(limpiar($_POST['tipo']))->required();
                        $val->name('status')->value(limpiar($_POST['selStatus']))->required();

         
                        if ($val->isSuccess()) {
                        $fecha = new DateTime();

                            // guardar
                            $data = [
                                'nombre' => limpiar($_POST['nombre']),
                                'direccion' => limpiar($_POST['direccion']),
                                'tipo' => limpiar($_POST['tipo']),
                                'status' => limpiar($_POST['selStatus']),


                            ];
                            $id = SucursalModel::guardarSucursal($data);
                            Alertas::new(sprintf('La nueva sucursal %s se ha ingresado al sistema exito ', $data['nombre']));
                            header('Location:' . base_url . '/sucursal');
                        } else {
                            Alertas::new($val->getErrors(), 'danger');
                            header('Location:' . base_url . '/sucursal/nuevo');
                        }
                    } catch (PDOException $e) {
                        Alertas::new($e->getMessage(), 'danger');
                        header('Location:' . base_url . '/sucursal/nuevo');
                    }
                }
            } else {
                Alertas::new("No tiene permiso para realizar esta accion", 'warning');
                header('Location:' . base_url . '/sucursal/nuevo');
            }
        } else {
            // editar/actualizar el rol
            if (Permisos::updater()) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    try {
                        // validar
                        $val = new Validations();
                        $fecha = new DateTime();
                        $val->name('nombre')->value(limpiar($_POST['nombre']))->required();
                        $val->name('direccion')->value(limpiar($_POST['direccion']))->required();
                        $val->name('tipo')->value(limpiar($_POST['tipo']))->required();
                        $val->name('status')->value(limpiar($_POST['selStatus']))->required();
                        if ($val->isSuccess()) {
                            // actualizar
                            $data = [
                                'nombre' => limpiar($_POST['nombre']),
                                'direccion' => limpiar($_POST['direccion']),
                                'tipo' => limpiar($_POST['tipo']),
                                'status' => limpiar($_POST['selStatus']),

                            ];
                            $id = SucursalModel::actualizarSucursal($_POST['id'], $data);
                            Alertas::new(sprintf('La sucursal %s se ha actualizado con exito ', $data['nombre']));
                            header('Location:' . base_url . '/sucursal');
                        } else {
                            Alertas::new($val->getErrors(), 'danger');
                            header('Location:' . base_url . '/sucursal/edit');
                        }
                    } catch (PDOException $e) {
                        Alertas::new($e->getMessage(), 'danger');
                        header('Location:' . base_url . '/sucursal/edit');
                    }
                }
            } else {

                Alertas::new("No tiene permiso para ACTUALIZAR esta informacion", 'warning');
                header('Location:' . base_url . '/sucursal');
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

                $ide = SucursalModel::deleteSucursal($id);
                $dataJson = ['status' => true, 'msg' => Alertas::new(sprintf('La informacion de la sucursal  %s se ha eliminado correctamente', $_POST['id']), 'danger')];
            }
        } else {
            $dataJson = ['status' => false, 'msg' => Alertas::new('No tiene permisos para realizar esta accion', 'danger')];
        }
        echo json_encode($dataJson, JSON_UNESCAPED_UNICODE);
    }
}
