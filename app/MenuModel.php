<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | MenuModel.php: 后端菜单模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------


namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use Config;

use Lang;

use Illuminate\Pagination\Paginator;

class MenuModel extends Model {

    protected $table    = 'menu';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获取单个菜单
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function findMenu($id){
        return DB::table('menu')->where('id', '=', $id)->first();
    }

    /**
     * 获得全部菜单（编辑菜单时选项）
     *
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllForSchemaOption(){
        //加载函数库
        load_func('common');
        $data = merge_tree_node(obj_to_array(DB::table('menu')->get()));

        $ids    = [];
        $menus  = [];
        if(!empty($data)){
            foreach($data as $v){
                array_push($ids, $v['id']);
                array_push($menus, $v['menu_name']);
            }
        }
        return [
            'ids'   => implode('|', $ids),
            'menus' => implode('|', $menus),
        ];
    }


}