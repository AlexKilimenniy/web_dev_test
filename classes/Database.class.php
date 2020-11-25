<?php

class Database 
{

    public $hConn;

    public function __construct() 
    {
        try {

            if(!$this->hConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
                throw new DB_Exception('Невозможно подключиться к БД');
    	    }
	  
            if(!@mysqli_query($this->hConn, 'SET NAMES utf8')) {
                throw new DB_Exception('Ошибка в установлении кодировки соединения с БД','',$this->hConn);
            }
        } catch (DB_Exception $e) {}
    }

    public function query($sql) {
        try {
  		    $result = @mysqli_query($this->hConn, $sql);
  		    if(mysqli_error($this->hConn)) {
  		        throw new DB_Exception('Ошибка запроса к БД', $sql, $this->hConn);
  		    }
            return ($result) ? $result : false;
        } catch (DB_Exception $e) {}
    }
  
    public function select($sql, $id_field = '') 
    {
        if (!$this->hConn) $this->__construct();
        try {
            $result = @mysqli_query($this->hConn, $sql);
            if(!$result) {
                throw new DB_Exception('Ошибка выборки из БД', $sql, $this->hConn);
            }
            $return = array();
            while($row = mysqli_fetch_assoc($result)) {
                // $return[] = $row;
	   	    	if ($id_field)
	    		    $return[$row[$id_field]] = $row;
                else
		    	    $return[] = $row;
            }
            return $return;
        } catch (DB_Exception $e){}
    }

    public function update($table, $fields_values, $options, $equal = '=')
    {
        try {
            $Updates = array();
            foreach($fields_values as $field => $val)
            {
                if ($val === null) {
         	        $Updates[] = "$field = NULL";
                } elseif(!is_numeric($val) AND !get_magic_quotes_gpc()) {
                    $val = mysqli_real_escape_string($this->hConn, trim($val));
                    $Updates[] = "$field = '$val'";
                } else {
                    $Updates[] = "$field = '$val'";
                }
            }

            $Where = array();
            foreach($options as $field => $val) {
                $Where[] = "$field " . $equal . " '$val'";
            }

            $sql = 'UPDATE `' . $table . '` SET ' . join(', ', $Updates) . ' WHERE ' . join(' AND ', $Where);

            if(!$result = @mysqli_query($this->hConn, $sql)) {
                throw new DB_Exception('Ошибка обновления записей в БД', $sql, $this->hConn);
            }
            return $result;
        }
        catch (DB_Exception $e) {}
    }

    function delete($table, $options)
    {
        try {
            $Where = array();
            foreach($options as $field => $val) {
                $Where[] = "$field = '$val'";
            }

            $sql = "DELETE FROM `" . $table . "` WHERE " . join(" AND ", $Where);

            if(!$result = @mysqli_query($this->hConn, $sql)) {
                throw new DB_Exception('Ошибка удаления записей в БД', $sql, $this->hConn);
            }
            return $result;
        } catch (DB_Exception $e) {}
    }

    public function insert($table, $fields_values, $returnID=null) 
    {
        try {
            $fields = array_keys($fields_values);
            $values = array_values($fields_values);

            $escVals = "";
            $firstIter = true;
            foreach($values as $val)
            {
                if(!$firstIter)
                {
                    $escVals.= ", ";
                }
                if ($val === null)
                {
                    $escVals.='NULL';
                }
                else
                {
                    $escVals.= "'".mysqli_real_escape_string( $this->hConn, trim($val) )."'";
                }
                $firstIter = false;
            }
		
            $sql = "INSERT INTO `" . $table . "` (`" . join("`, `", $fields) . "`) VALUES ($escVals)";
            if(!$result = mysqli_query($this->hConn, $sql)) {
                throw new DB_Exception('Ошибка вставки записей в БД', $sql, $this->hConn);
            }
            if ($returnID != null) return mysqli_insert_id($this->hConn);
            else return $result;
        } catch (DB_Exception $e) {}
    }

    public function __destruct() 
    {
        if($this->hConn) {
            @mysqli_close($this->hConn);
        }
    }
    
    public function paramStr($param, $allowable_tags = '', $use_strip_tags = true)
    {
        if (is_null($param)) return 'NULL';
        if ($param === 'NOW()') return 'NOW()';
        if ($param === 'CURDATE()') return 'CURDATE()';
    
        // проверка наличия соединения с БД
        if (! $this->hConn)
            $this->connect();
    
        if ($use_strip_tags)
            $param = strip_tags($param, $allowable_tags);
    
        $param = mysqli_real_escape_string($this->hConn, $param);
        $param = '"' . $param . '"';
    
        return $param;
    }
    
    public function paramInt($param)
    {
        if (is_null($param))
            return 'NULL';
    
        $param_int = intval($param);
        $param_float = $this->paramFloat(floor($param));
    
        if (! is_numeric($param))
            return $param_int;
        elseif ($param_int == $param_float)
        return $param_int;
        else
            return $param_float;
    }
    
    public function paramFloat($param)
    {
        if (is_null($param))
            return 'NULL';
    
        return str_replace(',', '.', floatval($param));
    }
}
