<?php
class SucursalModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    static function allSucursales()
    {
        return $sucursal = DB::query("SELECT * FROM sucursal");
    }
    static function deleteSucursal($id)
    {
        return $id = DB::delete('sucursal', ['id' => $id], 1);
    }

    static function guardarSucursal($data)
    {
        return $id = DB::insert('sucursal', $data);
    }

    static function editSucursal($id)
    {
        $sucursal = DB::query("SELECT * FROM sucursal WHERE id = {$id}");
        return $sucursal[0];
    }
    static function actualizarSucursal($id, $data)
    {
        return $res = DB::update('sucursal', $data, ['id' => $id]);
    }
}
