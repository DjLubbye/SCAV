<?php
class Incidencias extends Controller
{
    public $views;


    public function __construct()
    {
        parent::__construct();
        Permisos::getPermisos(INCIDENCIAS);
    }

    public function index()
    {
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url . "/login");
        }
        //consulta que trae toda la informacion
        $arrJson = [];
        $siniestros = IncidenciasModel::allSiniestros();


        $this->views->getView($this, "index", [
            'page_name' => "Control de Siniestros",
            'function_js' => "Incidencias.js",
            'siniestros' => to_obj($siniestros),
        ]);
    }
    public function nuevo()
    {

        $sucursales = IncidenciasModel::allSucursales();
        $operadores = IncidenciasModel::allOperadores();
        $placas = IncidenciasModel::allVehiculos();
        $this->views->getView($this, "nuevo", [
            'page_name' => "Registro de Siniestro",
            'sucursales' => to_obj($sucursales),
            'operadores' => to_obj($operadores),
            'placas' => to_obj($placas),
            'function_js' => "Incidencias.js",

        ]);
    }


    //Editar
    public function edit($id)
    {
        if (Permisos::read()) {

            $idSin = intval(limpiar($id));

            if ($idSin > 0) {
                $sini = IncidenciasModel::editSiniestro($idSin);
                if (empty($sini)) {
                    Alertas::new('ESTE REGISTRO NO EXISTE', 'warning');
                    header('Location:' . base_url . '/incidencias');
                }
                //SI EXISTE EL ID MOSTRAMOS EL REGISTRO EN LA VISTA
                $this->views->getView($this, "edit", [
                    'page_name' => "Editando Siniestro " . $sini['folio'],
                    'function_js' => "Incidencias.js",
                    //convertir el arreglo en objetos
                    'sini' => to_obj($sini),
                ]);
            } else {
                header('Location:' . base_url . '/incidencias');
            }
            return;
        }
        Alertas::new('No tiene permiso para realizar esta accion', 'warning');
        header('Location:' . base_url . '/incidencias');
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
                        $val->name('nombre')->value(limpiar($_POST['nombre']))->required();
                        $val->name('hora')->value(limpiar($_POST['hora']))->required();


                        $val->name('tipo de siniestro')->value(limpiar($_POST['tipo_siniestro']))->required();
                        $val->name('cedis')->value(limpiar($_POST['cedis']))->required();
                        $val->name('centro de costos')->value(limpiar($_POST['centro_costos']))->required();
                        $val->name('destino')->value(limpiar($_POST['destino']))->required();
                        $val->name('averiguacion previa')->value(limpiar($_POST['av_pre']))->required();
                        $val->name('conductor')->value(limpiar($_POST['conductor']))->required();
                        $val->name('linea')->value(limpiar($_POST['linea']))->required();

                        $val->name('placas')->value(limpiar($_POST['placas']))->required();
                        $val->name('razon social')->value(limpiar($_POST['razon_social']))->required();
                        $val->name('numero economico')->value(limpiar($_POST['numero_economico']))->required();
                        $val->name('estado de ocurrecia')->value(limpiar($_POST['estado_ocurrecia']))->required();
                        $val->name('resumen')->value(limpiar($_POST['resumen']))->required();
                        $val->name('municipio de ocurrencia')->value(limpiar($_POST['municipio_ocurrencia']))->required();
                        $val->name('folio de la aseguradora')->value(limpiar($_POST['folio_aseguradora']))->required();

                        $val->name('valor total del embarque')->value(limpiar($_POST['valor_t_embarque']))->required();
                        $val->name('monto perdida bruta')->value(limpiar($_POST['perdida_bruta']))->required();
                        $val->name('deducible')->value(limpiar($_POST['deducible']))->required();
                        $val->name('monto perdida neta')->value(limpiar($_POST['monto de perdida neta']))->required();









                        $val->name('status SYF')->value(limpiar($_POST['status_syf']))->required();

                        if ($val->isSuccess()) {
                            $fecha = new DateTime();
                            $nombreArchivo = $fecha->getTimestamp() . "_" . $_POST["placas"];


                            // guardar
                            $data = [
                                'folio' => $nombreArchivo ,
                                'nombre_reporta' => limpiar($_POST['nombre']),
                                'cedis' => limpiar($_POST['cedis']),
                                'centro_costos' => limpiar($_POST['centro_costos']),
                                'destino' => limpiar($_POST['destino']),
                                'tipo_siniestro' => limpiar($_POST['tipo_siniestro']),
                                'averiguacion_p' => limpiar($_POST['av_pre']),
                                'conductor' => limpiar($_POST['conductor']),
                                'hora_siniestro' => limpiar($_POST['hora']),
                                'placas_vehiculo' => limpiar($_POST['placas']),
                                'razon_social' => limpiar($_POST['razon_social']),
                                'numero_economico' => limpiar($_POST['numero_economico']),
                                'estado_ocurrecia' => limpiar($_POST['estado_ocurrecia']),
                                'municipio_ocurrencia' => limpiar($_POST['municipio_ocurrencia']),
                                'folio_aseguradora' => limpiar($_POST['folio_aseguradora']),
                                'status_syf' => limpiar($_POST['status_syf']),



                                'resumen' => limpiar($_POST['resumen']),











                            ];
                            $id = IncidenciasModel::guardarSiniestro($data);
                            Alertas::new(sprintf('Se registro el siniestro %s con exito ', $data['folio']), 'success');
                            header('Location:' . base_url . '/incidencias');
                        } else {
                            Alertas::new($val->getErrors(), 'danger');
                            header('Location:' . base_url . '/incidencias/nuevo');
                        }
                    } catch (PDOException $e) {
                        Alertas::new($e->getMessage(), 'danger');
                        header('Location:' . base_url . '/incidencias/nuevo');
                    }
                }
            } else {
                Alertas::new("No tiene permiso para realizar esta accion", 'danger');
                header('Location:' . base_url . '/incidencias/nuevo');
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

