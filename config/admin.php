<?php
$menu = [
    [
        "key"   => "dashboard",
        "title" => "admin.menu.dashboard.title",
        "icon"  => "ri-stack-line",
        "route" => "dashboard.index",
        'sort'       => 1,
    ],
    [
        "key"   => "account",
        "title" => "admin.menu.account.title",
        "icon"  => "ri-account-circle-line",
        "route" => "dashboard.index",
        'sort'       => 1,
    ],
    [
        "key"   => "account.users",
        "title" => "admin.menu.users.title",
        "icon"  => "ri-account-circle-line",
        "route" => "dashboard.users.index",
        'sort'       => 1,
    ],
    [
        "key"   => "account.roles",
        "title" => "admin.menu.roles.title",
        "icon"  => "ri-account-circle-line",
        "route" => "dashboard.roles.index",
        'sort'       => 1,
    ],
    [
        "key"   => "customers",
        "title" => "admin.menu.customers.title",
        "icon"  => "ri-account-circle-line",
        "route" => "dashboard.customers.index",
        'sort'       => 1,
    ],
//    [
//        "key"   => "reports",
//        "title" => "admin.menu.reports.title",
//        "icon"  => " ri-newspaper-fill",
////        "route" => "dashboard.index",
//        'sort'       => 1,
//    ],
    [
        "key"   => "campaigns_index",
        "title" => "admin.menu.campaigns.title",
        "icon"  => " ri-newspaper-fill",
        "route" => "dashboard.campaigns.index",
        'sort'       => 2,
    ],

    [
        "key"   => "campaigns_register",
        "title" => "admin.menu.campaigns_register.title",
        "icon"  => " ri-newspaper-fill",
        "route" => "dashboard.campaigns.register.index",
        'sort'       => 2,
    ],
    [
        "key"   => "reports",
        "title" => "admin.menu.reports.title",
        "icon"  => "ri-settings-5-fill",
        "route" => "dashboard.reports.kols.revenue",
        'sort'       => 1,
    ],
    [
        "key"   => "reports.kols-revenue",
        "title" => "Thu Nhập KOL",
        "icon"  => "ri-settings-5-fill",
        "route" => "dashboard.reports.kols.revenue",
        'sort'       => 1,
    ],
    [
        "key"   => "settings",
        "title" => "admin.menu.settings.title",
        "icon"  => "ri-settings-5-fill",
        "route" => "dashboard.settings.index",
        'sort'       => 1,
    ]

];

return [
    "menu" => $menu,
    'admin_prefix' => 'dashboard',
    'guard' => 'web',
];