<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16/1/13
 * Time: 下午10:27
 * Class DBTool
 */

class DBTool {
    const DB_TYPE = 'mysql';
    const DB_NAME = 'smsbao_guest';
    const DB_HOST = 'rdsnaiuevviy3yb.mysql.rds.aliyuncs.com'; // 127.0.0.1
    const DB_USER = 'smsbao_guest'; // root
    const DB_PWD = 'smsbao_g335';
    const DB_CHAR_SET = 'utf8';
    const QUERY_TYPE_ONE = 1;
    const QUERY_TYPE_ROW = 2;
    const QUERY_TYPE_ALL = 3;
    const REPLACE_INSERT = 1;

    private $pdo;
    private static $instance = null;
    private $statement;
    private $queryResoult;

    private function __construct() {
        $this->pdo = $this->conn();
        $this->setChar();
    }

    private function __clone() {}

    /**
     * 获取单例对象
     * @return DBTool|null
     */
    public static function getInstance() {

        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 连接数据库
     * @return null|PDO
     */
    private function conn() {
        $dsn = self::DB_TYPE . ':host=' . self::DB_HOST.';dbname='.self::DB_NAME;
        $pdo = null;
        $db = null;

        try {
            $pdo = new PDO($dsn, self::DB_USER, self::DB_PWD);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $pdo;
    }

    /**
     * 设置字符集
     * @return void
     */
    private function setChar() {
        $this->pdo->query('SET NAMES ' . self::DB_CHAR_SET);
    }

    /**
     * 获取指定表的所有字段名
     * @param $table string 表名
     * @return array 字段数组
     */
    private function getFields($table) {
        $arr = array();
        $sql = "DESC {$table}";
        $data = $this->query($sql);

        foreach ($data as $item) {
            $arr[] = $item['Field'];
        }

        return $arr;
    }

    /**
     * 删除操作
     * @param $bindValArr array 绑定的参数键值列表，key是绑定的参数，value是被绑定的值。(:key=>value...)
     * @param $table string 表名
     * @param $where string where条件
     * @return int 成功返回受到影响的行数
     */
    public function delete($bindValArr, $table, $where) {

        $sql = "DELETE FROM {$table} WHERE {$where}";

        if (is_array($bindValArr)) {
            $this->statement = $this->setBind($sql, $bindValArr);

            return $this->statement->rowCount();
        }

        return $this->pdo->exec($sql);

    }

    /**
     * 修改条件
     * @param $setVals array 拼接的set条件。update set key=value...
     * @param $table string 表名
     * @param $bindValArr array 绑定的参数键值列表。(:key=>value...)
     * @param $where string where条件
     * @return bool|int 成功返回受到影响的行数
     */
    public function update($setVals, $table, $bindValArr, $where) {

        $fields = $this->getFields($table);

        if (empty($where)) {

            return false;
        }

        $sql = "UPDATE {$table} SET ";

        foreach ($setVals as $key=>$item) {

            if (in_array($key, $fields)) {
                $sql .= "`{$key}`={$item},";
            }
        }

        $sql = trim($sql, ',') . " where $where";
        $this->statement = $this->setBind($sql, $bindValArr);

        return $this->statement->rowCount();
    }

    /**
     * 新增操作
     * @param $vals array 拼接sql语句的key和value
     * @param $table string 表名
     * @param $bindValArr array 绑定的参数键值列表
     * @return string 返回最新插入的id。
     */
    public function insert($vals, $table, $bindValArr, $typ=0) {
        $keys = $values = '';

        $fields = $this->getFields($table);

        $sql = 0 === $typ ? "INSERT INTO {$table} (" : "REPLACE INTO {$table} (";

        foreach ($vals as $k=>$item) {
            if (in_array($k, $fields)) {
                $keys .= "`{$k}`,";
                $values .= "{$item},";
            }
        }

        $sql .= trim($keys, ',') . ') values (' . trim($values, ',') . ')';
        $this->statement = $this->setBind($sql, $bindValArr);

        return $this->pdo->lastInsertId();
    }

    /**
     * 获取查询出的所有记录
     * @param $sql string sql语句
     * @param null $vals array 绑定的参数键值列表
     * @return array|bool|mixed|null|string 成功返回结果集
     */
    public function getAll($sql, $vals=null) {
        $data = null;

        if (null !== $vals) {
            $statement = $this->setBind($sql, $vals);

            if (false !== $this->queryResoult) {

                return $statement->fetchAll();
            }

            return false;
        }

        return $this->query($sql);
    }

    /**
     * 获取一条记录
     * @param $sql string sql语句
     * @param null $vals string 参数键值列表
     * @return array|bool|mixed|null|string 返回一条记录
     */
    public function getRow($sql, $vals=null) {
        $data = null;

        if (null !== $vals) {
            $statement = $this->setBind($sql, $vals);

            if (false !== $this->queryResoult) {
                return $statement->fetch();
            }

            return false;
        }

        return $this->query($sql, self::QUERY_TYPE_ROW);
    }

    /**
     * 返回一个值
     * @param $sql string sql语句
     * @param null $vals array 绑定的参数键值列表
     * @return array|bool|mixed|null|string
     */
    public function getOne($sql, $vals=null) {
        $data = null;

        if (null !== $vals) {
            $this->statement = $this->setBind($sql, $vals);

            if (false !== $this->queryResoult) {
                return $this->statement->fetchColumn();
            }

            return false;
        }

        return $this->query($sql, self::QUERY_TYPE_ONE);
    }


    /**
     * 预编译绑定参数
     * @param $sql string sql语句
     * @param $vals array 要绑定的参数键值列表
     * @return PDOStatement 返回POSStatement对象。
     */
    private function setBind($sql, $vals) {
        $statement = $this->pdo->prepare($sql);

        if (is_array($vals)) {

            foreach ($vals as $key=>$item) {
                $statement->bindValue($key, $item);
            }
        }

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $this->queryResoult = $statement->execute();

        return $statement;
    }

    /**
     * 普通执行sql，不执行绑定参数操作
     * @param $sql string sql语句
     * @param int $type 执行sql的fetch类型
     * @return array|mixed|null|string
     */
    private function query($sql, $type=3) {
        $res = $this->pdo->query($sql);
        $res->setFetchMode(PDO::FETCH_ASSOC);

        $data = null;

        switch ($type) {
            case 1:
                $data = $res->fetchColumn();
                break;
            case 2:
                $data = $res->fetch();
                break;
            default:
                $data = $res->fetchAll();
                break;
        }

        return $data;
    }

    public function getErr() {
        return $this->statement->errorInfo();
    }

    public function startTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function rollback() {
        return $this->pdo->rollBack();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function isTransaction() {
        return $this->pdo->inTransaction();
    }
} 