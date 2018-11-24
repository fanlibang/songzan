<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 分类
 *
 * Class Category
 */
class Category
{
    /**
     * 初始化
     */
	public function __construct(){
	}

    /**
     * ios 分类
     *
     * @param null $fatherid
     * @param null $class_son_id
     * @return array
     */
    public function iosCategory($fatherid = null, $class_son_id = null){
        $category_arr       =   array();

        //主类别
        $class_son_id_arr   =   array();
        $classid_arr        =   array();

        $config_arr_1 = read_config('common.ios_father_types');

        foreach ((array)$config_arr_1 as $k => $v) {
            $arr = array($k, $v['name']);

            $class_son_id_arr[$k] = $arr;
        }

        if (isset($class_son_id) && isset($config_arr_1[$class_son_id]['class_son'])) {

            $config_arr_11 = $config_arr_1[$class_son_id]['class_son'];

            foreach ((array)$config_arr_11 as $k => $v) {
                $arr = array($v['classid'], $v['class_name']);
                $classid_arr[$v['classid']] = $arr;
            }
        }

        $category_arr['class_son_id_arr']   =   $class_son_id_arr;
        $category_arr['classid_arr']        =   $classid_arr;

        //父类别
        $fatherid_arr = array(
            99999997=>  array(99999997,'软件' ),
            6014    =>  array(6014,'游戏' ),
//            6021    =>  array(6021,'报刊杂志' )
        );

        $childid_arr  =   array();

        $config_arr_2 = read_config('common.ios_child_types');

        if (isset($class_son_id)) {
            $new_config_arr = array();
            foreach ((array)$config_arr_2 as $k => $v) {
                if ($fatherid == 99999997) {
                    if ($k < 7000) {
                        $new_config_arr[$k] = $v;
                    }
                } elseif ($fatherid == 6014) {
                    if ($k >= 7000 && $k < 8000) {
                        $new_config_arr[$k] = $v;
                    }
                } elseif ($fatherid == 6021) {
                    if ($k >= 13000 && $k < 14000) {
                        $new_config_arr[$k] = $v;
                    }
                }
            }

            foreach ((array)$new_config_arr as $k => $v) {
                $arr = array($k, $v['name']);

                $childid_arr[$k] = $arr;
            }
        }

        $category_arr['fatherid_arr']   =   $fatherid_arr;
        $category_arr['childid_arr']    =   $childid_arr;

        return $category_arr;
    }

    /**
     * 获取子类别的详细信息
     *
     * @param null $id
     * @return array
     */
    public function iosChildClassInfo($id = null){
        $config_arr = read_config('common.ios_child_types');

        return $id ? ($config_arr[$id] ? $config_arr[$id] : array()) : array();
    }

    /**
     * android 分类
     *
     * @param null $pindex
     * @param null $cindex
     * @return array
     */
    public function androidCategory($pindex = null, $cindex = null){

        if ($pindex == null || !in_array($pindex, array('hot', 'game'))) {
            return array(array('', '请选择1'));
        }

        $category_data  = json_decode(curl_request('http://apk.interface.xyzs.com/apk/1.4.0/category', '', 'get', 0, 3, 3), true);

        $category_arr = isset($category_data['data'][$pindex]) ? $category_data['data'][$pindex] : array();

        if ($cindex) {
            if ($pindex == 'game') {
                $category_arr = array_index_value($category_arr, 'code');
                $category_arr = $category_arr[$cindex]['childs'];
            }
        }

        $new_ret = array();
        foreach ((array)$category_arr as $k => $v) {
            $arr = array($v['code'], $v['title']);

            $new_ret[] = $arr;
        }

        if (empty($new_ret)) {
            $new_ret = array(array('', '请选择2'));
        }

        return $new_ret;
    }
}