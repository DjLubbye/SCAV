<?php
class OperadoresModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    static function allOperadores()
    {
        return $operadores = DB::query("SELECT * FROM operadores");
    }
    static function seleccionarimagen($id)
    {
        $operimg = DB::query("SELECT foto FROM operadores WHERE id = {$id}");
        return $operimg[0];
    }
    static function deleteOpera($id)
    {
        return $id = DB::delete('operadores', ['id' => $id], 1);
    }
    static function guardarOpera($data)
    {
        return $id = DB::insert('operadores', $data);
    }
    static function editOpera($id)
    {
        $oper = DB::query("SELECT * FROM operadores WHERE id = {$id}");
        return $oper[0];
    }
    static function actualizarOpera($id, $data)
    {
        return $res = DB::update('operadores', $data, ['id' => $id]);
    }

}
