<?php
class VehiculosModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    static function allVehiculos()
    {
        return $vehiculos = DB::query("SELECT * FROM vehiculos");
    }
     static function deletevehi($id){
        return $id = DB::delete('vehiculos',['id' => $id], 1);
     }
     static function guardarVehiculo($data){
        return $id = DB::insert('vehiculos', $data);
     }
     static function editVeh($id)
     {
         $vehi = DB::query("SELECT * FROM vehiculos WHERE id = {$id}");
         return $vehi[0];
        
     }
     static function actualizarVehi($id, $data)
     {
         return $res = DB::update('vehiculos', $data, ['id' => $id]);
     }

   
}