<?php
class DatabaseManager {
    const DB_NAME = '';
    const HOST = 'localhost';
    const CHARSET = 'utf8';
    const USER = '';
    const PASSWORD = '';

    /**
     * @return PDO
     */
    function pdo() {
        $dsn = "mysql:dbname=".self::DB_NAME.";host=".self::HOST.";charset=".self::CHARSET;
        try {
            $pdo = new PDO($dsn, self::USER, self::PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(Exception $e) {
            die('error'.$e->getMessage());
        }
        return $pdo;
    }

    /**
     * @param string $sql
     * @return array
     */
    function query(string $sql) {
        try {
            $pdo = $this->pdo();
            $stmt = $pdo->query($sql);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error!<br>'.$e->getMessage());
        }
        return self::array_escape($items);
    }

    /**
     * @param string $sql
     * @param array $param
     * @return bool|PDOStatement
     */
    function execute(string $sql, array $param) {
        try {
            $pdo = $this->pdo();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(self::array_escape($param));
        } catch (Exception $e) {
            die('Error!<br>'.$e->getMessage());
        }
        return $stmt;
    }

    /**
     * @param string $sql
     * @param array $param
     * @return array
     */
    function get(string $sql, array $param) {
        try {
            $stmt = $this->execute($sql, $param);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error!<br>'.$e->getMessage());
        }
        return self::array_escape($data);
    }

    /**
     * @param array $array
     * @return array
     */
    private static function array_escape(array $array) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::array_escape($value);
            } else {
                $array[$key] = self::escape($value);
            }
        }
        return $array;
    }

    /**
     * @param string $value
     * @return string
     */
    private static function escape(string $value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}