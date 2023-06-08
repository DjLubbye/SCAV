<?php
class QR extends Controller
{
    public function __construct()
    {
        Auth::noAuth();
        Permisos::getPermisos(QR);
        parent::__construct();
    }

    public function index()
    //SEGURIDAD
    {
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url . "/login");
        }
        //consulta que trae toda la informacion
        $visitas = QRModel::allvisitas();
        $operadores = QRModel::allOperadores();
        $sucursales = QRModel::allSucursales();



        $this->views->getView($this, "index", [
            'page_name' => "Acceso Vehicular por QR",
            'function_js' => "QR.js",
            'visitas' => to_obj($visitas),
            'operadores' => to_obj($operadores),
            'sucursales' => to_obj($sucursales),

            

        ]);
    }
        //Editar
        public function edit($id)
        {
            if (Permisos::read()) {
    
                $idAcc = intval(limpiar($id));
    
                if ($idAcc > 0) {
                    $acceso = QRModel::editarAccesos($idAcc);
                    if (empty($idAcc)) {
                        Alertas::new('ESTE REGISTRO NO EXISTE', 'warning');
                        header('Location:' . base_url . '/qr');
    
                        
                    }
                    //SI EXISTE EL ID MOSTRAMOS EL REGISTRO EN LA VISTA
                    $this->views->getView($this, "edit", [
                        'page_name' => "Editando Vehiculo Numero " . $acceso['id'],
                        'function_js' => "QR.js",
                        //convertir el arreglo en objetos
                        'acces' => to_obj($acceso),
                    ]);
                } else {
                    header('Location:' . base_url . '/qr');
                }
                return;
            }
            Alertas::new('No tiene permiso para realizar esta accion', 'warning');
            header('Location:' . base_url . '/qr');
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
                            $val->name('fechatxt')->value(limpiar($_POST['fechatxt']))->required();
                            $val->name('horatxt')->value(limpiar($_POST['horatxt']))->required();
                            $val->name('resTurno')->value(limpiar($_POST['resTurno']))->required();
                            $val->name('Operador')->value(limpiar($_POST['selOper']))->required();
                            $val->name('Destino')->value(limpiar($_POST['selDestino']))->required();




                            $vehiculo = QRModel::existevehiculo(limpiar($_POST['clave_vehiculo']));
                            if (empty($vehiculo)) { //si viene vacia la variable
                                Alertas::new("No existe este Vehiculo en el sistema", 'danger');
                                header('Location:' . base_url . '/QR');
                            }
                           elseif ($val->isSuccess()) {
                            
                                // guardar
                                $data = [
                                    'clave_vehiculo' => limpiar($_POST['clave_vehiculo']),
                                    'fecha' => limpiar($_POST['fechatxt']),
                                    'hora_entrada' => limpiar($_POST['horatxt']),
                                    'destino' => limpiar($_POST['selDestino']),
                                    'responsable' => limpiar($_POST['resTurno']),
                                    'operador_encargado' => limpiar($_POST['selOper']),

                                ];
    
                                $id = QRModel::guardarAccesos($data);
                                Alertas::new(sprintf('Acceso del vehiculo %s se regisro correctamenta. Responsable de este acceso  %s', $data['clave_vehiculo'], $data['responsable']));

                                header('Location:' . base_url . '/QR');
                            } else {
                                Alertas::new($val->getErrors(), 'danger');
                                header('Location:' . base_url . '/QR');
                            }
                        } catch (PDOException $e) {
                            Alertas::new($e->getMessage(), 'danger');
                            header('Location:' . base_url . '/QR');
                        }
                    }
                } else {
                    Alertas::new("No tiene permiso para realizar esta accion", 'danger');
                    header('Location:' . base_url . '/QR');
                }
            }else{
            // editar/actualizar la visita
            if (Permisos::updater()) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    try {
                        // validar
                        $val = new Validations();
                        $val->name('clave_vehiculo')->value(limpiar($_POST['clave_vehiculo']))->required();
                        $val->name('fechatxt')->value(limpiar($_POST['fechatxt']))->required();
                        $val->name('horatxt')->value(limpiar($_POST['horatxt']))->required();
                        $val->name('resTurno')->value(limpiar($_POST['resTurno']))->required();
                        if ($val->isSuccess()) {
                            // guardar
                            $data = [
                                'clave_vehiculo' => limpiar($_POST['clave_vehiculo']),
                                'fecha' => limpiar($_POST['fechatxt']),
                                'hora_entrada' => limpiar($_POST['horatxt']),
                                'responsable' => limpiar($_POST['resTurno']),

                            ];
                            $id = QRModel::guardarAccesos($data);
                            Alertas::new(sprintf('El Acceso del vehiculo %s se ha creado con exito ', $data['clave_vehiculo']));
                            header('Location:' . base_url . '/QR');
                        } else {
                            Alertas::new($val->getErrors(), 'danger');
                            header('Location:' . base_url . '/QR');
                        }
                    } catch (PDOException $e) {
                        Alertas::new($e->getMessage(), 'danger');
                        header('Location:' . base_url . '/QR');
                    }
                }
            } else {

                Alertas::new("No tiene permiso para ACTUALIZAR esta informacion", 'warning');
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
                $horaSalida = limpiar($_POST['horatxt']); 

                
                $ide = QRModel::registrarSalida($id, $horaSalida);

                $dataJson = ['status' => true, 'msg' => Alertas::new(sprintf('Se registro correctamente la salida vehiculo, visita numero %s ', $_POST['id']), 'success')];
            }
        } else {
            $dataJson = ['status' => false, 'msg' => Alertas::new('No tiene permisos para realizar esta accion', 'warning')];
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
                    $ide = QRModel::deleteAccesos($id);
                    $dataJson = ['status' => true, 'msg' => Alertas::new(sprintf('La informacion del acceso numero %s se ha eliminado correctamente', $_POST['id']), 'success')];
                }
            } else {
                $dataJson = ['status' => false, 'msg' => Alertas::new('No tiene permisos para realizar esta accion', 'warning')];
            }
            echo json_encode($dataJson, JSON_UNESCAPED_UNICODE);
        }
    }
    