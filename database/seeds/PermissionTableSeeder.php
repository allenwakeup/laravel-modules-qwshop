<?php

namespace Goodcatch\Modules\Qwshop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{

    const TB_PERMISSION_GROUP = 'permission_groups';
    const TB_PERMISSIONS = 'permissions';
    const TB_MENUS = 'menus';
    const TB_ROLE_MENUS = 'role_menus';
    const TB_ROLE_PERMISSIONS = 'role_permissions';

    const URI_PREFIX = 'laravel-modules/admin';

    const MENUS = [
        [
            'name' => '系统模块',
            'children' => [
                [
                    'name' => '模块管理',
                    'link' => '/' . self::URI_PREFIX . '/modules',
                ]
            ]
        ]
    ];

    const API_GROUPS = [
        '模块化管理' => [
            'modules'
        ]
    ];

    const API_RESOURCE_ACTIONS = [
        'index' => ['name' => '列表', 'content' => '列表展示'],
        'store' => ['name' => '添加', 'content' => '数据添加'],
        'show' => ['name' => '详情', 'content' => '单个详情'],
        'update' => ['name' => '修改', 'content' => '数据修改'],
        'destroy' => ['name' => '删除', 'content' => '数据删除']
    ];

    const ROLE_ADMIN_ID = 1;



    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $this->addMenu(
            0,
            self::MENUS
        );

        foreach(self::API_GROUPS as $group => $resources){
            $t_permission_groups = DB::table(self::TB_PERMISSION_GROUP);

            $permission_group = $t_permission_groups->where('name', $group)->first();
            $group_id = isset($permission_group)
                ? $permission_group->id
                : $t_permission_groups->insertGetId(['name' => $group]);

            foreach($resources as $resource){
                $t_permissions = DB::table(self::TB_PERMISSIONS);
                foreach(self::API_RESOURCE_ACTIONS as $action => $data){
                    $apis = $resource . '.' . $action;
                    $unique = [
                        'apis' => $apis,
                        'pid' => $group_id
                    ];
                    if($t_permissions->updateOrInsert($unique, $data)){
                        $this->addRolePermissions(
                            self::ROLE_ADMIN_ID,
                            $unique
                        );
                    }
                }
            }
        }


    }

    private function addMenu($pid = 0, $menus = []){
        if(count($menus) > 0){
            foreach($menus as $k => $menu){
                $name = Arr::get($menu, 'name');
                $link = Arr::get($menu, 'link', '#');
                $unique = [
                    'name' => $name,
                    'link' => $link,
                    'pid' => $pid,
                ];
                if(DB::table(self::TB_MENUS)->updateOrInsert($unique, [
                    'is_type' => 0,
                    'is_sort' => 0
                ])){
                    $children = Arr::get($menu, 'children', []);
                    $created = DB::table(self::TB_MENUS)->where($unique)->first();
                    if(empty($children)){
                        $this->addRoleMenus(self::ROLE_ADMIN_ID, $created);
                    }else{
                        $this->addMenu($created->id, $children);
                    }
                }
            }
        }
    }

    private function addRoleMenus($role_id, $menu){
        if(isset($menu)){
            $t_role_menus = DB::table(self::TB_ROLE_MENUS);
            $t_role_menus->updateOrInsert([
                'role_id' => $role_id,
                'menu_id' => $menu->id
            ], []);
        }
    }

    private function addRolePermissions($role_id, $permission_unique){
        $t_permissions = DB::table(self::TB_PERMISSIONS);
        $permission = $t_permissions->where($permission_unique)->first();
        if(isset($permission)){
            $t_role_permissions = DB::table(self::TB_ROLE_PERMISSIONS);
            $t_role_permissions->updateOrInsert([
                'role_id' => $role_id,
                'permission_id' => $permission->id
            ], []);
        }
    }
}
