<?php
class Recepcion extends Controller
{
    public function __construct()
    {
        Auth::noAuth();
        Permisos::getPermisos(RECEPCION);
        parent::__construct();
    }

    public function index()
    //SEGURIDAD
    {
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url . "/login");
        }
        //consulta que trae toda la informacion
        $recepcion = RecepcionModel::allRecepcion();



        $this->views->getView($this, "index", [
            'page_name' => "Historial de Visitas",
            'function_js' => "Recepcion.js",
            'recepcion' => to_obj($recepcion)
        ]);
    }
    //agregar la vista de nuevo

    public function edit($id)
    {
        if (Permisos::read()) {

            $idRece = intval(limpiar($id));

            if ($idRece > 0) {
                $recep = RecepcionModel::editRecep($idRece);
                if (empty($recep)) {
                    Alertas::new('ESTE REGISTRO NO EXISTE', 'warning');
                    header('Location:' . base_url . '/recepcion');
                }
                //SI EXISTE EL ID MOSTRAMOS EL REGISTRO EN LA VISTA
                $this->views->getView($this, "edit", [
                    'page_name' => "Editando la visita de " . $recep['nombre'],
                    'function_js' => "Recepcion.js",
                    //convertir el arreglo en objetos
                    'recep' => to_obj($recep),
                ]);
            } else {
                header('Location:' . base_url . '/recepcion');
            }
            return;
        }
        Alertas::new('No tiene permiso para realizar esta accion', 'warning');
        header('Location:' . base_url . '/recepcion');
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
                        $val->name('responsable')->value($_POST['resTurno'])->required();
                        $val->name('num_gaf')->value($_POST['gafete'])->required();
                        $val->name('nombre')->value($_POST['nombreVisitante'])->required();
                        $val->name('compania')->value($_POST['compania'])->required();
                        $val->name('visita_a')->value($_POST['aVisita'])->required();
                        $val->name('asunto')->value($_POST['selAsunto'])->required();
                        $val->name('fecha')->value($_POST['fechatxt'])->required();
                        $val->name('h_entrada')->value($_POST['horatxt'])->required();
                        if ($val->isSuccess()) {
   
                            // guardar
                            $data = [
                                'responsable' => limpiar($_POST['resTurno']),
                                'num_gaf' => limpiar($_POST['gafete']),
                                'nombre' => limpiar($_POST['nombreVisitante']),
                                'compania' => limpiar($_POST['compania']),
                                'visita_a' => limpiar($_POST['aVisita']),
                                'asunto' => limpiar($_POST['selAsunto']),
                                'fecha' => limpiar($_POST['fechatxt']),
                                'h_entrada' => limpiar($_POST['horatxt']),
                            ];

                            $id = RecepcionModel::guardarRecepcion($data);
                            Alertas::new(sprintf('Se registro correctamente la visita de %s con el gafete %s', $data['nombre'], $data['num_gaf']));
                            header('Location:' . base_url . '/recepcion');
                        } else {
                            Alertas::new($val->getErrors(), 'danger');
                            header('Location:' . base_url . '/recepcion');
                        }
                    } catch (PDOException $e) {
                        Alertas::new($e->getMessage(), 'danger');
                        header('Location:' . base_url . '/recepcion');
                    }
                }
            } else {
                Alertas::new("No tiene permiso para realizar esta accion", 'warning');
                header('Location:' . base_url . '/recepcion/nuevo');
            }
        } else {
            // editar/actualizar el rol
            if (Permisos::updater()) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    try {
                        // validar
                        $val = new Validations();
                        //campos del BD-------------------campo del Form
                        $val->name('h_salida')->value($_POST['horatxt'])->required();
                        if ($val->isSuccess()) {
                            // actualizar
                            $data = [
                                'h_salida' => limpiar($_POST['horatxt']),
                            ];

                            $id = RecepcionModel::guardarFEcha($_POST['id']);
                            Alertas::new(sprintf('El Vehiculo placas %s se ha actualizado con exito ', $data['placas']));
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
    public function salida()

    {
        if (Permisos::updater()) {
            $dataJson = [];
            if (empty($_POST['id'])) {
                $dataJson = ['status' => false, 'msg' => 'No se recibieron los datos'];
            } else {
                $id = intval(limpiar($_POST['id']));
                $ide = RecepcionModel::registrarSalida($id);
                $dataJson = ['status' => true, 'msg' => Alertas::new(sprintf('Se registro salida de la visita numero %s correctamente', $_POST['id']), 'successs')];
            }
        } else {
            $dataJson = ['status' => false, 'msg' => Alertas::new('No tiene permisos para realizar esta accion', 'danger')];
        }
        echo json_encode($dataJson, JSON_UNESCAPED_UNICODE);
    }
    public function destroy()

    {
        if (Permisos::deleter()) {
            $dataJson = [];
            if (empty($_POST['id'])) {
                $dataJson = ['status' => false, 'msg' => 'No se recibieron los datos'];
            } else {
                $id = intval(limpiar($_POST['id']));
                $ide = RecepcionModel::deleterecep($id);
                $dataJson = ['status' => true, 'msg' => Alertas::new(sprintf('La informacion de la visitante %s se ha eliminado correctamente', $_POST['nombre']), 'danger')];
            }
        } else {
            $dataJson = ['status' => false, 'msg' => Alertas::new('No tiene permisos para realizar esta accion', 'danger')];
        }
        echo json_encode($dataJson, JSON_UNESCAPED_UNICODE);
    }
}
