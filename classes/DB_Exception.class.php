<?php
class DB_Exception extends Exception {
   
    /**
     * Прерывать скрипт при возникновени ошибки?
     * @var boolean
     */
    public static $EXIT = true;
    
    /**
     * Логировать ошибки в файл?
     * @var string
     */
    public static $LOG = true;
    
   var $error = array();
    
   function __construct($msg, $sql='', $db_handler = null) {
       
   	   $this->error = error_get_last();
       $this->error['mysql_error'] = mysqli_error($db_handler);
       $this->error['mysql_errno'] = mysqli_errno($db_handler);
       $this->error['filename']    = $_SERVER['SCRIPT_NAME'];
       if($sql!='') 
           $this->error['sql']     = '<pre>--- SQL query was: ---<br /><br />' . $sql . '</pre>';
       $this->error['msg'] = $msg;

       if (self::$LOG) {
           $this->log(print_r($this->error, true));
       }
       
       if (DEBUG_MODE != 1) {
           $this->error = array();
           $this->error['msg'] = $msg;
       }
       
       if (self::$EXIT) {
           header('Location:/error');
           die();
       }
   }
   
   protected function log($msg)
   {
       try {
           $msg .= ' (' . $this->getFile() . ':' . $this->getLine() . ')';
           $msg .= ' ' . $this->getTraceAsString() . ' ';
           $msg = date("Y-m-d H:i:s") . ' - ' . $msg . "\r\n";
           
           $file = 'exception_db_' . date('Y_m_d') . '.log';
           
           // пишем в файл
           $fp = fopen(SITE_ROOT . 'log/' . $file, 'a+');
           fwrite($fp, $msg);
            
           // закрываем файл
           fclose($fp);
       } catch (Exception $e) {
           
       }
   }
}
