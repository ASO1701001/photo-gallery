<?php
class PhotoManager {
    const thumbnail_root_path = '/img/photo_thumbnail/';
    const full_root_path = '/img/photo_master/';

    /**
     * @return array
     */
    public static function getAllImage() : array {
        require_once 'DatabaseManager.php';
        $db = new DatabaseManager();
        $temp = $db->query("SELECT id, title, full_image, thumbnail_image FROM photo");
        $data = array();
        foreach ($temp as $row) {
            $data[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'full_image' => self::full_root_path.$row['full_image'],
                'thumbnail_image' => self::thumbnail_root_path.$row['thumbnail_image']
            );
        }
        return $data;
    }

    /**
     * @param $id
     * @return string
     */
    /*
    public static function getThumbnailImagePath($id) : string {
        require_once 'DatabaseManager.php';
        $db = new DatabaseManager();
        $data = $db->get("SELECT thumbnail_image FROM photo WHERE id = :id", array(
            'id' => $id
        ));
        foreach ($data as $row) {
            return self::thumbnail_root_path.$row['thumbnail_image'];
        }
        return null;
    }
    */

    /**
     * @param $id
     * @return string
     */
    /*
    public static function getFullImagePath($id) : string {
        require_once 'DatabaseManager.php';
        $db = new DatabaseManager();
        $data = $db->get("SELECT full_image FROM photo WHERE id = :id", array(
            'id' => $id
        ));
        foreach ($data as $row) {
            return self::full_root_path.$row['full_image'];
        }
        return null;
    }
    */

    /**
     * @param $id
     * @return string
     */
    /*
    public static function getTitle($id) : string {
        require_once 'DatabaseManager.php';
        $db = new DatabaseManager();
        $data = $db->get("SELECT title FROM photo WHERE id = :id", array(
            'id' => $id
        ));
        foreach ($data as $row) {
            return $row['title'];
        }
        return null;
    }
    */

    /**
     * @param $id
     * @return string
     */
    /*
    public static function getDetails($id) : string {
        require_once 'DatabaseManager.php';
        $db = new DatabaseManager();
        $data = $db->get("SELECT details FROM photo WHERE id = :id", array(
            'id' => $id
        ));
        foreach ($data as $row) {
            return $row['details'];
        }
        return null;
    }
    */

    /**
     * @param $keyword
     * @return array
     */
    public static function getSearch($keyword) : array {
        require_once 'DatabaseManager.php';
        $db = new DatabaseManager();
        $temp = $db->get("SELECT id, title, full_image, thumbnail_image FROM photo WHERE title LIKE :key1 OR details LIKE :key2", array(
            'key1' => '%'.$keyword .'%',
            'key2' => '%'.$keyword .'%'
        ));
        $data = array();
        foreach ($temp as $row) {
            $data[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'thumbnail_image' => self::thumbnail_root_path.$row['thumbnail_image'],
                'full_image' => self::full_root_path.$row['full_image']
            );
        }
        return $data;
    }
}