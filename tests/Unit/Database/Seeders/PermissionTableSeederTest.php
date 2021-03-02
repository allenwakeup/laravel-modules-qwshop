<?php


/**
 *
 * This file <PermissionTableSeederTest.php> was created by <PhpStorm> at <2021/3/2>,
 * and it is part of project <laravel-modules-qwshop>.
 * @author  Allen Li <ali@goodcatch.cn>
 */

namespace Tests\Unit\Database\Seeders;
use Illuminate\Support\Arr;
use PHPUnit\Framework\TestCase;

class PermissionTableSeederTest extends TestCase
{
    const TB_PERMISSION_GROUP = 'permission_groups';
    const TB_PERMISSIONS = 'permissions';

    const API_GROUPS = [
        '系统管理' => [
            'sys'
        ],
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

    private $permission_groups = [
        [
            'id' => 1,
            'name' => '模块化管理'
        ]
    ];

    private $permissions = [
        [
            'id' => 1,
            'pid' => 1,
            'apis' => 'sys.index',
            'content' => '系统配置列表'
        ]
    ];

    public function testRun(){

        \collect(self::API_GROUPS)->each(function ($resources, $group) {
            $permission_group = \collect($this->permission_groups)->firstWhere('name', $group);
            if(isset($permission_group)){
                $group_id = $permission_group['id'];
            }else{
                $group_id = count($this->permission_groups) + 1;
                $this->permission_groups [] = [
                    'id' => $group_id,
                    'name' => $group
                ];
            }
            \collect($resources)->each(function($resource) use($group_id) {
                \collect (self::API_RESOURCE_ACTIONS)->each(function ($data, $action) use ($resource, $group_id) {
                    $this->permissions = \collect($this->permissions)
                        ->reduce(function ($arr, $item)use($data, $resource, $action, $group_id) {
                            if(Arr::get($item, 'apis') === ($resource . '.' . $action)
                                && Arr::get($item, 'pid') === $group_id){
                                $arr->push(array_merge(
                                    $item,
                                    $data
                                ));
                            }else{
                                $arr->push($item);
                            }
                            return $arr;
                        }, \collect([]))
                        ->values()
                        ->all();

                    if(\collect($this->permissions)->filter(function($item)use($resource, $action, $group_id){
                        return Arr::get($item, 'apis') === ($resource . '.' . $action)
                            && Arr::get($item, 'pid') === $group_id;
                        })->count() === 0){
                        $this->permissions[] = array_merge(
                            $data,
                            [
                                'id' => count($this->permissions) + 1,
                                'pid' => $group_id,
                                'apis' => $resource . '.' . $action
                            ]
                        );
                    }
                });
            });
        });

        $this->assertTrue(count($this->permission_groups) === 2, 'add new permissions' . count($this->permission_groups));
    }
}