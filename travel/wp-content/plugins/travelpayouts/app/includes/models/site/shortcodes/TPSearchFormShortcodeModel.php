<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 12.08.15
 * Time: 18:39
 */
namespace app\includes\models\site\shortcodes;
class TPSearchFormShortcodeModel {
    public static $tableName = "tp_search_shortcodes";
    public function get_dataId($id)
    {
        if(!$id) return false;
        global $wpdb;
        $tableName = $wpdb->prefix .self::$tableName;
        $data = $wpdb->get_row("SELECT * FROM ".$tableName ." WHERE id= ".(int)$id, ARRAY_A);
        if(count($data) > 0) return $data;
        return false;
    }
}