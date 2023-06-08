<?php
class RecepcionModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }
    
    static function allRecepcion()
    {
        return $recepcion = DB::query("SELECT * FROM recepcion");
    }

    static function deleterecep($id){
        return $id = DB::delete('recepcion',['id' => $id], 1);
     }
     static function guardarRecepcion($data){
        return $id = DB::insert('recepcion', $data);
     }
     static function registrarSalida($id)
     {
         date_default_timezone_set("America/Mexico_City");
         $hora = date("h:i A");
         $oper = DB::query("UPDATE recepcion SET h_salida='$hora', status='0' WHERE id = {$id}");
 
     }


     static function editRecep($id)
     {
         $recep = DB::query("SELECT * FROM recepcion WHERE id = {$id}");
         return $recep[0];
        
     }
     static function actualizarRecep($id, $data)
     {
         return $res = DB::update('recepcion', $data, ['id' => $id]);
     }

   
}