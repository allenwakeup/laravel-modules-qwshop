export default [

    // 模块化后台界面
    {path:"/laravel-modules/admin/index",name:"laravel_modules_admin_index",component:()=>import("@/views/Admin/index"),children:[

        {path:"/laravel-modules/admin/index",name:"laravel_modules_admin_default",component:()=>import("@/views/Admin/default")}, // 打开默认页面
            // 模块管理
        {path:"/laravel-modules/admin/modules",name:"laravel_modules_admin_modules",component:()=>import("@/views/laravel-modules/admin/modules/index")},
        {path:"/laravel-modules/admin/modules/form/:id?",name:"laravel_modules_admin_modules_form",component:()=>import("@/views/laravel-modules/admin/modules/form")},
    ]},
];
