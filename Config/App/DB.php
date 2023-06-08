<?php
class DB extends Conexion
{

        public static function consultarSQL($query)
        {
            $link = new Conexion();
            $link=$link->conect();
            $resultado = $link->query($query);
            $array = [];

            while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
                $array[] = $registro;
        }
        $resultado->closeCursor();
        return $array;
    }
/**
 * 
 * Consultar de forma plana un sql
 * @param string $sql
 */
public static function SQL($query)
{
$resultado = self::consultarSQL($query);
return $resultado;


}



    //listar registros desdela base de datos
    public static function listEqual($table, $params = [], $limit = null)
    {
        $cols_values = "";
        $limits = "";

        if (!empty($params)) {
            $cols_values .= "WHERE";
            foreach ($params as $key => $value) {
                $cols_values .= " {$key} = :{$key} AND";
            }
            $cols_values = substr($cols_values, 0, -3);
        }

        if ($limit !== null) {
            $limits = " LIMIT {$limit}";
        }
        $stmt = "SELECT * FROM $table {$cols_values}{$limits}";

        //llamar query de la base de datos
        if (!$rows = parent::query($stmt, $params)) {
            return false;
        }
        return $limit === 1 ? $rows[0] : $rows;
    }
    //METODO JOIN UNIR TABLAS//
    public static function join($table1, $table2, $val1, $val2,  $params = [], $limit = null)
    {
        $cols_values = "";
        $limits = "";

        if (!empty($params)) {
            $cols_values .= "WHERE";
            foreach ($params as $key => $value) {
                $cols_values .= " {$key} = :{$key} AND";
            }
            $cols_values = substr($cols_values, 0, -3);
        }

        if ($limit !== null) {
            $limits = " LIMIT {$limit}";
        }


        $stmt = "SELECT * FROM $table1 
    INNER JOIN $table2 
    ON $table1.$val1 = $table2.$val2
    {$cols_values}{$limits}";

        //llamar query de la base de datos
        if (!$rows = parent::query($stmt, $params)) {
            return false;
        }
        return $limit === 1 ? $rows[0] : $rows;
    }

    //INSERTAR REGISTROS
    public static function insert($table, $params)
    {
        $cols = "";
        $placeholders = "";
        foreach ($params as $key => $value) { //insert into roles(nombre_rol,estado_rol)
            $cols .= "{$key} ,";
            $placeholders .= ":{$key} ,";
        }
        $cols = substr($cols, 0, -1); //sustraemos la ultima coma para que se ejecute la consulta correctamente
        $placeholders = substr($placeholders, 0, -1);
        $stmt = "INSERT INTO {$table}({$cols}) VALUES ({$placeholders})";

        if ($id = parent::query($stmt, $params)) {
            return $id;
        } else {
            return false;
        }
    }


    //ACTUALIZAR  update REGISTROS
    public static function update($table, $params = [], $id = [])
    {
        $cols = "";
        $placeholders = "";
        foreach ($params as $key => $value) { //UPDATE
            $placeholders .= " {$key} = :{$key} ,";
        }
        $placeholders = substr($placeholders, 0, -1); //sustraemos la ultima coma para que se ejecute la consulta correctamente

        if (count($id) > 1) {
            foreach ($id as $key => $value) {
                $cols .= " $key = :$key AND";
            }
            $cols = substr($cols, 0, -3);
        } else {
            foreach ($id as $key => $value) {
                $cols .= " $key = :$key";
            }
        }
        $stmt = "UPDATE $table SET $placeholders WHERE $cols";
        if (!parent::query($stmt, array_merge($params, $id))) {
            return false;
        }
        return true;
    }
    //eliminar registros
    public static function delete($table, $params = [], $limit = 1)
    {
        $cols_values = "";
        $limits = "";
        if (!empty($params)) {
            $cols_values = " WHERE ";
            foreach ($params as $key => $value) {
                $cols_values .= "{$key} = :{$key} AND";
            }
            $cols_values = substr($cols_values, 0, -3);
        }
        if ($limit != null) {
            $limits = " LIMIT {$limit}";
        }
        $stmt = "DELETE FROM $table {$cols_values}{$limits}";

        if (!$row = parent::query($stmt, $params)) {
            return false;
        }
        return $row;
    }
}
