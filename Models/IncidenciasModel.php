<?php
class IncidenciasModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    static function allSiniestros()
    {
        return $siniestro = DB::query("SELECT * FROM siniestros");
    }

    public static function allOperadores()
    {
      $operadores = DB::SQL("SELECT * FROM operadores WHERE status != 0");
      return $operadores;
    }
    public static function allSucursales()
  {
    $sucursal = DB::SQL("SELECT * FROM sucursal WHERE status != 0");
    return $sucursal;
  }
    static function allVehiculos()
    {
        return $placas = DB::query("SELECT * FROM vehiculos");
    }

     static function deleteSiniestro($id){
        return $id = DB::delete('siniestros',['id' => $id], 1);
     }
     static function guardarSiniestro($data){
        return $id = DB::insert('siniestros', $data);
     }
     static function editSiniestro($id)
     {
         $vehi = DB::query("SELECT * FROM siniestros WHERE id = {$id}");
         return $vehi[0];
        
     }
     static function actualizarSiniestro($id, $data)
     {
         return $res = DB::update('siniestros', $data, ['id' => $id]);
     }

   
}