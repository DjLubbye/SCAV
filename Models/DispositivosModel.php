<?php
class DispositivosModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function codigo_barras_exist(string $codigo_barras)
    {
      //consulta usando pdo
      $sql = "SELECT * FROM disp_cb WHERE codigo_barras= :codigo_barras LIMIT 1";
      return ($rows = parent::query($sql, ['codigo_barras' => $codigo_barras])) ? $rows[0] : [];
  }
  public static function allvisitas()
  {
    $respuesta = DB::SQL("SELECT dis.id, cb.responsable_dispositivo, cb.codigo_barras, dis.fecha, dis.hora_entrada, dis.hora_salida, dis.resp_revision, dis.status FROM disp_cb cb INNER JOIN dispositivos dis ON cb.id = dis.id_disp");
    return $respuesta;
  }
    static function visitasaccesos()
    {
        return $visitas = DB::query("SELECT * FROM dispositivos WHERE fecha = CURDATE() ");
    }
    public static function registrarSalida($id, $horaSalida)
    {
        $horaSalida = $_POST['horatxt'];
        $oper = DB::query("UPDATE dispositivos SET hora_salida = '$horaSalida', status = '0' WHERE id = {$id}");
        
    }
    

    static function allaccesos()
    {
        return $accesos_disp = DB::query("SELECT * FROM dispositivos WHERE fecha = CURDATE() ");
    }
   

    static function eliminar($id)
    {
        return $id = DB::delete('dispositivos', ['id' => $id], 1);
    }
    static function guardarAccesos($data)
    {
        return $id = DB::insert('dispositivos', $data);
    }
    static function editarAccesos($id)
    {
        $oper = DB::query("SELECT * FROM accesovehicular WHERE id = {$id}");
        return $oper[0];
    }

}
