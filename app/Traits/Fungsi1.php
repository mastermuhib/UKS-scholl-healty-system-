<?php

namespace App\Traits1;

use Illuminate\Http\Request;
use App\MenuModel;
use DB;

trait Fungsi1 {

    public static function getmenu($role_id)
    {
        $menu = DB::table('menus')->whereNull('deleted_at')->join('role_menus','menus.id','=','role_menus.menu_id')->where('role_id',$role_id)->where('menus.parent_menu_id',0)->select('menus.menu_name as name','serial_number','slug','icon','menus.menu_id as menu_id','parent_menu_id')->orderBy('serial_number','asc')->get();

        return $menu;

    }

    public static function getmenuall()
    {
        $menu = DB::table('menus')->whereNull('deleted_at')->where('menus.parent_menu_id',0)->select('menus.menu_name as name','serial_number','slug','icon','menus.menu_id as menu_id','parent_menu_id','menus.id as id')->orderBy('serial_number','asc')->get();
         // print_r($menu);
         // exit();
        return $menu;

    }

    public static function getsubmenu($role_id)
    {
        $submenu = DB::table('menus')->whereNull('deleted_at')->join('role_menus','menus.id','=','role_menus.menu_id')->where('role_id',$role_id)->where('menus.menu_id',0)->select('menus.menu_name as name','serial_number','slug','icon','menus.menu_id as menu_id','parent_menu_id')->orderBy('serial_number','asc')->get();
        return $submenu;
    }

    public static function getsubmenuall()
    {
        $submenu = DB::table('menus')->whereNull('deleted_at')->where('menus.menu_id',0)->select('menus.menu_name as name','serial_number','slug','icon','menus.menu_id as menu_id','parent_menu_id','menus.id as id')->orderBy('serial_number','asc')->get();
        return $submenu;
    }

    public static function S3_PATH(){
        $env = 'https://metadev.nos.jkt-1.neo.id/';
        return $env;
    }
    public static function AWS_SECRET_ACCESS_KEY(){
        $env = '0e1e15b03dd56d1c81f8';
        return $env;
    }
    public static function AWS_ACCESS_KEY_ID(){
        $env = 'ZBTOs5kc6nwRKNZrHobN36c+kJ095NY0Oyi4R55g';
        return $env;
    }

    public static function FIREBASE_CREDENTIAL(){
        $env = 'AAAAjuwxOJA:APA91bE_Dm1VxIEHKrwlbRygvm5lp5MoEBXHMGJZJUMZIpkgDm_JI6kMTxOgkEzCOS7e5p7a_xMap296c73W9j1JnaEQI7fQSCyo9y1WCaQjajWrgmikbXEeuGYAQJdklVr1BLZame3c';
        return $env;
    }


}

?>
