<?
/*
 *2011-1-14
 *
 *From :YumDam
 *
 *E-mail:yumdam@yumdam.com
 *
 *QQ:992360020
 *
 *http://www.yumdam.com/
 *
 */

$GLOBALS['dbhost'] = $dbhost;
$GLOBALS['dbname'] = $dbname;
$GLOBALS['dbuser'] = $dbuser;
$GLOBALS['dbpass'] = $dbpass;
$GLOBALS['dbsname'] = $dbsname;
$GLOBALS['dbcharset'] = $dbcharset;


class YumDam_DB_Connet //类的开始 
{
    public $conn;
    public $dbhost;
    public $dbname;
    public $dbuser;
    public $dbpass;
    public $dbsname;
    public $dbcharset;


    function __construct() //这个类方法是开始一个conn连接,然后开始选择数据库
    {
        global $GLOBALS;
        $this->dbhost = $GLOBALS['dbhost'];
        $this->dbname = $GLOBALS['dbname'];
        $this->dbuser = $GLOBALS['dbuser'];
        $this->dbpass = $GLOBALS['dbpass'];
        $this->dbsname = $GLOBALS['dbsname'];
        $this->dbcharset = $GLOBALS['dbcharset'];
        if ($this->dbhost == "" || $this->dbname == "" || $this->dbuser == "" || $this->dbpass == "" || $this->dbsname == "" || $this->dbcharset == "") {
            exit("参数出错！");
        }
        $this->conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die("数据库连接出错！");
#echo $this->dbhost."|".$this->dbuser."|".$this->dbpass."|".$this->dbname;exit;
        mysql_select_db($this->dbname, $this->conn) or die("数据库选择出错！");
        mysql_query("SET NAMES '" . $this->dbcharset . "'") or die("数据库设置出错");
    }


    function selectdb($s_field, $s_table, $s_condition = "1", $output = false)
    {
        $s_table = str_replace("#_@", $this->dbsname, $s_table);
        $s_field = str_replace("#_@", $this->dbsname, $s_field);
        $s_condition = str_replace("#_@", $this->dbsname, $s_condition);
        if ($s_field == "") {
            $s_field = " * ";
        }
        $sql = "select " . $s_field . " from " . $s_table . " where " . $s_condition;
        if ($output == true) {
            echo $sql;
        }
        $res = mysql_query($sql);
        while ($array = mysql_fetch_array($res)) {
            $result['select'][] = $array;
        }
        if ($result['error'] = mysql_error() != "") {
            die($sql . '<br><br>' . mysql_error());
        }
        $result['row'] = mysql_num_rows($res);
        return $result;
    }


    function selectsql($s_field, $output = false)
    {
        $s_field = str_replace("#_@", $this->dbsname, $s_field);
        if ($output == true) {
            echo $s_field;
        }
        $res = mysql_query($s_field);
        while ($array = mysql_fetch_array($res)) {
            $result['select'][] = $array;
        }
        if ($result['error'] = mysql_error() != "") {
            die($sql . '<br><br>' . mysql_error());
        }
        $result['row'] = mysql_num_rows($res);
        return $result;

    }

    function updatedb($u_table, $u_field, $u_condition, $output = false)
    {
        $u_table = str_replace("#_@", $this->dbsname, $u_table);
        $u_field = str_replace("#_@", $this->dbsname, $u_field);
        $u_condition = str_replace("#_@", $this->dbsname, $u_condition);
        $sql = "update " . $u_table . " set " . $u_field . " where " . $u_condition;
        if ($output == true) {
            echo $sql;
        }
        $res = mysql_query($sql);
        if ($result['error'] = mysql_error() != "") {
            die($sql . '<br><br>' . mysql_error());
        }
        $result['affect'] = mysql_affected_rows();///影响记录数
        return $result;
    }

    function insertdb($i_table, $i_field1, $i_field2, $output = false)
    {
        $i_table = str_replace("#_@", $this->dbsname, $i_table);
        $sql = "insert into " . $i_table . "(" . $i_field1 . ")" . " values " . "(" . $i_field2 . ")";
        if ($output == true) {
            echo $sql;
        }
        $res = mysql_query($sql);
        if ($result['error'] = mysql_error() != "") {
            die($sql . '<br><br>' . mysql_error());
        }
        $result['affect'] = mysql_affected_rows();///影响记录数
        $result['id'] = mysql_insert_id();
        return $result;
    }


    function deletedb($d_table, $d_condition, $output = false)
    {
        $d_table = str_replace("#_@", $this->dbsname, $d_table);
        $d_condition = str_replace("#_@", $this->dbsname, $d_condition);
        $sql = "delete from " . $d_table . " where " . $d_condition;
        if ($output == true) {
            echo $sql;
        }
        $res = mysql_query($sql);
        if ($result[error] = mysql_error() != "") {
            die($sql . '<br><br>' . mysql_error());
        }
        $result['affect'] = mysql_affected_rows();
        return $result;
    }


    function CloseDB()
    {
        mysql_close();
    }

}//类结束

?>