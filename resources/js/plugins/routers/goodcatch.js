export default [

    // 模块化后台界面
    {path:"/goodcatch/admin/index",name:"goodcatch_admin_index",component:()=>import("@/views/Admin/index"),children:[

        {path:"/goodcatch/admin/index",name:"goodcatch_admin_default",component:()=>import("@/views/Admin/default")}, // 打开默认页面
            // 模块管理
        {path:"/goodcatch/admin/modules",name:"goodcatch_admin_modules",component:()=>import("@/views/goodcatch/admin/modules/index")},
        {path:"/goodcatch/admin/modules/form/:id?",name:"goodcatch_admin_modules_form",component:()=>import("@/views/goodcatch/admin/modules/form")},
    ]},
];
