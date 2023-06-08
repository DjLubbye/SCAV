<?php
class QRModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function existevehiculo(string $serie)
    {
        //consulta usando pdo
        $sql = "SELECT * FROM vehiculos WHERE serie= :serie LIMIT 1";
        return ($rows = parent::query($sql, ['serie' => $serie])) ? $rows[0] : [];
    }
    public static function allOperadores()
    {
        $operad = DB::SQL("SELECT * FROM operadores WHERE status = '1'");
        return $operad;
    }
    static function  registrarSalida($id, $horaSalida)
    {
        $horaSalida = $_POST['horatxt'];
        $oper = DB::query("UPDATE accesovehicular SET hora_salida= '$horaSalida', status='0' WHERE id = {$id}");
    }

    static function allvisitas()
    {
        return $visitas = DB::query("SELECT * FROM accesovehicular WHERE fecha = CURDATE() ");
    }
    public static function allSucursales()
    {
        $sucursales = DB::SQL("SELECT * FROM sucursal");
        return $sucursales;
    }

    static function deleteAccesos($id)
    {
        return $id = DB::delete('accesovehicular', ['id' => $id], 1);
    }
    static function guardarAccesos($data)
    {
        return $id = DB::insert('accesovehicular', $data);
    }
    static function editarAccesos($id)
    {
        $oper = DB::query("SELECT * FROM accesovehicular WHERE id = {$id}");
        return $oper[0];
    }
    static function actualizarAccesos($id, $data)
    {
        return $res = DB::update('accesovehicular', $data, ['id' => $id]);
    }
}
