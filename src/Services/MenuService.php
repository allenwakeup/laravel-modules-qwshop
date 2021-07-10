<?php

namespace Goodcatch\Modules\Qwshop\Services;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\RoleMenu;
use App\Models\RolePermission;
use App\Services\MenuService as Service;
use Goodcatch\Modules\Qwshop\Traits\PermissionSeedsTrait;

class MenuService
{
    use PermissionSeedsTrait;

    private $app;

    private $permissionGroups;

    private $menus;

    private $menu_service;

    public function __construct($app)
    {
        $this->app = $app;
        $this->menu_service = new Service;
    }

    /**
     * set menus
     *
     * @param $menus
     * @return $this
     */
    public function setSeedsMenus($menus){
        $this->menus = $menus;
        return $this;
    }

    /**
     * set permission groups
     * @param $permissionGroups
     * @return $this
     */
    public function setSeedsPermissionGroups($permissionGroups){
        $this->permissionGroups = $permissionGroups;
        return $this;
    }

    public function getSeedsMenus (){
        return $this->menus;
    }

    public function getSeedsPermissionGroups (){
        return $this->permissionGroups;
    }

    public function flush(){
        $this->menu_service->clearCache();
    }

    public function remove($links = [], $apis = []){
        if(!empty($links)){
            $exist_menus = Menu::query()->whereIn('link', $links)->get()->pluck('id')->all();
            if(!empty($exist_menus)){
                Menu::query()->whereIn('id', $exist_menus)->delete();
                RoleMenu::query()->whereIn('menu_id', $exist_menus)->delete();
            }

        }
        if(!empty($apis)){

            $exist_permissions = Permission::query()->whereIn('apis', $apis)->get()->pluck('id')->all();
            if(!empty($exist_permissions)){
                Permission::query()->whereIn('id', $exist_permissions)->delete();
                RolePermission::query()->whereIn('permission_id', $exist_permissions)->delete();
            }
        }
    }
}