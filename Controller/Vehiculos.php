<?php
class Vehiculos extends Controller
{
    public $views;

    public function __construct()
    {
        parent::__construct();
        Permisos::getPermisos(VEHICULOS);
    }
    public function index()
    //SEGURIDAD
    {
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url . "/login");
        }
        //consulta que trae toda la informacion
        $arrJson = [];
        $vehiculos = VehiculosModel::allVehiculos();



        $this->views->getView($this, "index", [
            'page_name' => "Informacion Vehicular",
            'function_js' => "Vehiculos.js",
            'vehiculos' => to_obj($vehiculos)
        ]);
    }
    //agregar la vista de nuevo
    public function nuevo()
    {
        $this->views->getView($this, "nuevo", [
            'page_name' => "Nuevo Vehiculo",
            'function_js' => "Vehiculos.js",

        ]);
    }
    //Editar
    public function edit($id)
    {
        if (Permisos::read()) {

            $idVeh = intval(limpiar($id));

            if ($idVeh > 0) {
                $vehi = VehiculosModel::editVeh($idVeh);
                if (empty($vehi)) {
                    Alertas::new('ESTE REGISTRO NO EXISTE', 'warning');
                    header('Location:' . base_url . '/vehiculos');
                }
                //SI EXISTE EL ID MOSTRAMOS EL REGISTRO EN LA VISTA
                $this->views->getView($this, "edit", [
                    'page_name' => "Editando Vehiculo " . $vehi['eco_dl'],
                    'function_js' => "Vehiculos.js",
                    //convertir el arreglo en objetos
                    'vehi' => to_obj($vehi),
                ]);
            } else {
                header('Location:' . base_url . '/vehiculos');
            }
            return;
        }
        Alertas::new('No tiene permiso para realizar esta accion', 'warning');
        header('Location:' . base_url . '/vehiculos');
    }
    public function store()
    {
        if (empty($_POST['id'])) {
            // crear nuevo rol

            if (Permisos::create()) {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    try {
                        // validar
                        $val = new Validations();
                        //campos del BD-------------------campo del Form
                        $val->name('tipo')->value(limpiar($_POST['tipo']))->required();
                        $val->name('marca')->value(limpiar($_POST['marca']))->required();
                        $val->name('serie')->value(limpiar($_POST['serie']))->required();
                        $val->name('placas')->value(limpiar($_POST['placas']))->required();
                        $val->name('m3')->value(limpiar($_POST['m3']))->required();
                        $val->name('eco_dl')->value(limpiar($_POST['eco_dl']))->required();
                        $val->name('u_n')->value(limpiar($_POST['u_n']))->required();
                        $val->name('activo')->value(limpiar($_POST['selStatus']))->required();
                        $val->name('fecha_alta')->value(limpiar($_POST['fecha']))->required();
                        $val->name('id_operador')->value(limpiar($_POST['id_operador']))->required();
                        if ($val->isSuccess()) {
                            require "phpqrcode/qrlib.php";
                            $fecha = new DateTime();
                            $nombreArchivo = $fecha->getTimestamp() . "_" . $_POST["serie"];
                            QRcode::png($_POST['serie'], "./Imagenes/" . $nombreArchivo . ".png", 'L', 5, 2);
                            // guardar
                            $data = [
                                'tipo' => limpiar($_POST['tipo']),
                                'marca' => limpiar($_POST['marca']),
                                'serie' => limpiar($_POST['serie']),
                                'placas' => limpiar($_POST['placas']),
                                'm3' => limpiar($_POST['m3']),
                                'eco_dl' => limpiar($_POST['eco_dl']),
                                'u_n' => limpiar($_POST['u_n']),
                                'activo' => limpiar($_POST['selStatus']),
                                'fecha_alta' => limpiar($_POST['fecha']),
                                'id_operador' => limpiar($_POST['id_operador']),
                                'QR' => $nombreArchivo . ".png",


                            ];
                            $id = VehiculosModel::guardarVehiculo($data);
                            Alertas::new(sprintf('El vehiculo %s se ha creado con exito ', $data['eco_dl']), 'success');
                            header('Location:' . base_url . '/vehiculos');
                        } else {
                            Alertas::new($val->getErrors(), 'danger');
                            header('Location:' . base_url . '/vehiculos/nuevo');
                        }
                    } catch (PDOException $e) {
                        Alertas::new($e->getMessage(), 'danger');
                        header('Location:' . base_url . '/vehiculos/nuevo');
                    }
                }
            } else {
                Alertas::new("No tiene permiso para realizar esta accion", 'danger');
                header('Location:' . base_url . '/vehiculos/nuevo');
            }
        } else {
            // editar/actualizar el rol
            if (Permisos::updater()) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    try {
                        // validar
                        $val = new Validations();
                        $val->name('tipo')->value(limpiar($_POST['tipo']))->required();
                        $val->name('marca')->value(limpiar($_POST['marca']))->required();
                        $val->name('serie')->value(limpiar($_POST['serie']))->required();
                        $val->name('placas')->value(limpiar($_POST['placas']))->required();
                        $val->name('m3')->value(limpiar($_POST['m3']))->required();
                        $val->name('eco_dl')->value(limpiar($_POST['eco_dl']))->required();
                        $val->name('u_n')->value(limpiar($_POST['u_n']))->required();
                        $val->name('activo')->value(limpiar($_POST['selStatus']))->required();
                        $val->name('id_operador')->value(limpiar($_POST['id_operador']))->required();
                        if ($val->isSuccess()) {
                            require "phpqrcode/qrlib.php";
                            $fecha = new DateTime();
                            $nombreArchivo = $fecha->getTimestamp() . "_" . $_POST["serie"];
                            QRcode::png($_POST['serie'], "./Imagenes/" . $nombreArchivo . ".png", 'L', 5, 2);
                            // actualizar

                            $data = [
                                'tipo' => limpiar($_POST['tipo']),
                                'marca' => limpiar($_POST['marca']),
                                'serie' => limpiar($_POST['serie']),
                                'placas' => limpiar($_POST['placas']),
                                'm3' => limpiar($_POST['m3']),
                                'eco_dl' => limpiar($_POST['eco_dl']),
                                'u_n' => limpiar($_POST['u_n']),
                                'activo' => limpiar($_POST['selStatus']),
                                'id_operador' => limpiar($_POST['id_operador']),
                                'QR' => $nombreArchivo . ".png",

                            ];

                            $id = VehiculosModel::actualizarVehi($_POST['id'], $data);
                            Alertas::new(sprintf('El Vehiculo placas %s se ha actualizado con exito ', $data['placas']), 'warning');
                            header('Location:' . base_url . '/vehiculos');
                        } else {
                            Alertas::new($val->getErrors(), 'danger');
                            header('Location:' . base_url . '/vehiculos/edit');
                        }
                    } catch (PDOException $e) {
                        Alertas::new($e->getMessage(), 'danger');
                        header('Location:' . base_url . '/vehiculos/edit');
                    }
                }
            } else {

                Alertas::new("No tiene permiso para ACTUALIZAR esta informacion", 'danger');
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
                $ide = VehiculosModel::deletevehi($id);
                $dataJson = ['status' => true, 'msg' => Alertas::new(sprintf('La informacion del vehiculo %s se ha eliminado correctamente', $_POST['eco_dl']), 'danger')];
            }
        } else {
            $dataJson = ['status' => false, 'msg' => Alertas::new('No tiene permisos para realizar esta accion', 'danger')];
        }
        echo json_encode($dataJson, JSON_UNESCAPED_UNICODE);
    }
}
