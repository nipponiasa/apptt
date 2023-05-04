<?php



return [



    /*

    |--------------------------------------------------------------------------

    | Title

    |--------------------------------------------------------------------------

    |

    | Here you can change the default title of your admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title

    |

    */



    'title' => 'Trade and Traffic Plus B.V. reporting platform',

    'title_prefix' => '',

    'title_postfix' => '',



    /*

    |--------------------------------------------------------------------------

    | Favicon

    |--------------------------------------------------------------------------

    |

    | Here you can activate the favicon.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon

    |

    */



    'use_ico_only' => true,

    'use_full_favicon' => false,



    /*

    |--------------------------------------------------------------------------

    | Logo

    |--------------------------------------------------------------------------

    |

    | Here you can change the logo of your admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo

    |

    */



    'logo' => '<b>B</b>usiness<b>I</b>ntelligence',

    'logo_img' => 'ttn.png',

    'logo_img_class' => 'brand-image img-circle elevation-3',

    'logo_img_xl' => null,

    'logo_img_xl_class' => 'brand-image-xs',

    'logo_img_alt' => 'Trade and Traffic',




   

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],



    /*

    |--------------------------------------------------------------------------

    | User Menu

    |--------------------------------------------------------------------------

    |

    | Here you can activate and change the user menu.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu

    |

    */



    'usermenu_enabled' => true,

    'usermenu_header' => false,

    'usermenu_header_class' => 'bg-primary',

    'usermenu_image' => true,

    'usermenu_desc' => false,

    'usermenu_profile_url' => false,



    /*

    |--------------------------------------------------------------------------

    | Layout

    |--------------------------------------------------------------------------

    |

    | Here we change the layout of your admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-layout

    |

    */



    'layout_topnav' => null,

    'layout_boxed' => null,

    'layout_fixed_sidebar' => null,

    'layout_fixed_navbar' => null,

    'layout_fixed_footer' => null,



    /*

    |--------------------------------------------------------------------------

    | Authentication Views Classes

    |--------------------------------------------------------------------------

    |

    | Here you can change the look and behavior of the authentication views.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#661-authentication-views-classes

    |

    */



    'classes_auth_card' => 'card-outline card-primary',

    'classes_auth_header' => '',

    'classes_auth_body' => '',

    'classes_auth_footer' => '',

    'classes_auth_icon' => '',

    'classes_auth_btn' => 'btn-flat btn-primary',



    /*

    |--------------------------------------------------------------------------

    | Admin Panel Classes

    |--------------------------------------------------------------------------

    |

    | Here you can change the look and behavior of the admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#662-admin-panel-classes

    |

    */



    'classes_body' => '',

    'classes_brand' => '',

    'classes_brand_text' => '',

    'classes_content_wrapper' => '',

    'classes_content_header' => '',

    'classes_content' => '',

    'classes_sidebar' => 'sidebar-dark-primary elevation-4',

    'classes_sidebar_nav' => '',

    'classes_topnav' => 'navbar-white navbar-light',

    'classes_topnav_nav' => 'navbar-expand',

    'classes_topnav_container' => 'container',



    /*

    |--------------------------------------------------------------------------

    | Sidebar

    |--------------------------------------------------------------------------

    |

    | Here we can modify the sidebar of the admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-sidebar

    |

    */



    'sidebar_mini' => true,

    'sidebar_collapse' => false,

    'sidebar_collapse_auto_size' => false,

    'sidebar_collapse_remember' => false,

    'sidebar_collapse_remember_no_transition' => true,

    'sidebar_scrollbar_theme' => 'os-theme-light',

    'sidebar_scrollbar_auto_hide' => 'l',

    'sidebar_nav_accordion' => true,

    'sidebar_nav_animation_speed' => 300,



    /*

    |--------------------------------------------------------------------------

    | Control Sidebar (Right Sidebar)

    |--------------------------------------------------------------------------

    |

    | Here we can modify the right sidebar aka control sidebar of the admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-control-sidebar-right-sidebar

    |

    */



    'right_sidebar' => false,

    'right_sidebar_icon' => 'fas fa-cogs',

    'right_sidebar_theme' => 'dark',

    'right_sidebar_slide' => true,

    'right_sidebar_push' => true,

    'right_sidebar_scrollbar_theme' => 'os-theme-light',

    'right_sidebar_scrollbar_auto_hide' => 'l',



    /*

    |--------------------------------------------------------------------------

    | URLs

    |--------------------------------------------------------------------------

    |

    | Here we can modify the url settings of the admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-urls

    |

    */



    'use_route_url' => false,



    'dashboard_url' => 'home',



    'logout_url' => 'logout',



    'login_url' => 'login',



    'register_url' => false, //'register'



    'password_reset_url' => 'password/reset',



    'password_email_url' => 'password/email',



    'profile_url' => false,



    /*

    |--------------------------------------------------------------------------

    | Laravel Mix

    |--------------------------------------------------------------------------

    |

    | Here we can enable the Laravel Mix option for the admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-laravel-mix

    |

    */



    'enabled_laravel_mix' => false,

    'laravel_mix_css_path' => 'css/app.css',

    'laravel_mix_js_path' => 'js/app.js',



    /*

    |--------------------------------------------------------------------------

    | Menu Items

    |--------------------------------------------------------------------------

    |

    | Here we can modify the sidebar/top navigation of the admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu

    |

    */



    'menu' => [

        [

            'text' => 'search',

            'search' => false,

            'topnav' => true,

        ],

        [

            'text' => 'blog',

            'url'  => 'admin/blog',

            'can'  => 'manage-blog',

        ],

        [

            'text'        => 'Go to Odoo',

            'url'         => 'https://odoo.trade-traffic.com',

            'icon'        => 'far fa-fw fa-file',

            'can' => 'isManager' ,  

            //'label'       => 1,

           // 'label_color' => 'success',

        ],

        // ['header' => 'account_settings',
        //     'can' => 'isManager' ,  
        // ],

        // [

        //     'text' => 'profile',

        //     'url'  => 'user_profile_edit',

        //     'icon' => 'fas fa-fw fa-user',

        //     'can' => 'isManager' ,  
            

        // ],


   
        [
        'header' => 'ADMINISTRATION',
        'can' => 'isAdmin'  ,  

        ],

        // [
        
        //      'text'    => 'User Management',
        
        //      'icon'    => 'fas fa-users-cog',

        //      'can' => 'isAdmin'  ,
        
        //      'submenu' => [
        
                 [
        
                     'text' => 'All Users',

                     'icon'    => 'fas fa-users-cog',
        
                     'url'  => 'user_list',

                     'can' => 'isAdmin',
                 ],
        
        
               
        
            //  ],
        
        //  ], 









     
      

        ['header' => 'CHECK FOR',
        'can' => 'isManager' ,  
    ],
        
       [

            'text'    => 'Model Availability',

            'icon'    => 'fas fa-warehouse',

            'can' => 'isManager'  ,

            'submenu' => [

                [

                    'text' => 'Current stock',

                    'url'  => 'current_stock',

                    'can' => 'isManager'  ,

                ],
                [

                    'text' => 'Non-deliverable stock',

                    'url'  => 'non_deliverable_stock',

                    'can' => 'isManager'  ,

                ],
         /*
         [

                    'text' => 'In consignment',

                    'url'  => 'in_consignment',

                ],   */


  [

                            'text' => 'Who Reserved What',

                            'url'  => 'who_reserved_what?serial=true',

                            'can' => 'isManager'  ,

                        ],
                        [

                            'text' => 'Who Demands What',

                            'url'  => 'who_demands_what?serial=true',

                            'can' => 'isManager'  ,

                        ],
                      /*   [

                            'text'    => 'Ready to ship',

                            'url'     => '#',

                          

                        ],

*/





              

            ],

        ], 



        [

            'text'    => 'SP Availability',
        
            'icon'    => 'fas fa-warehouse',

            'can' => 'isManager'  ,
        
            'submenu' => [
        
                        [
        
                            'text' => 'SP Catalogs',
        
                            'url'  => 'avail_per_catalog',

                            'can' => 'isManager'  ,
        
                        ],
            ],
        
        ], 









       




        ['header' => 'REPORTS',
        'can' => 'isManager' ,  
    ],

  

        ['text'    => 'Sales',

        'icon'    => 'fas fa-chart-bar',

        'can' => 'isManager'  ,

        'submenu' => [

            [
                
                'icon'    => 'fas fa-dollar-sign',

                'text' => 'Revenue Target',

                'url'  => 'revenue_target?year='.idate("Y"),

                'can' => 'isManager'  ,

            ],
             
           
            [

                'icon'    => 'fas fa-motorcycle',

                'text' => 'Units Target',

                'url'  => 'units_target?year='.idate("Y").'&month='.idate("m"),

                'can' => 'isManager'  ,

            ],





        ],
    
    ],     




        ['text'    => 'Consignements',

        'icon'    => 'fas fa-project-diagram',

        'can' => 'isManager'  ,

        'submenu' => [

            [

                'text' => 'Aged Consignment',

                'url'  => 'aged_consignments_model',

                'can' => 'isManager'  ,

            ],
             

        ],
    
    ],



    ['text'    => 'Dealers',

    'icon'    => 'far fa-address-book',

    'can' => 'isManager'  ,

    'submenu' => [

        [

            'text' => 'Info',

            'url'  => 'dealer_list',

            'can' => 'isManager'  ,

        ],
        [

            'text' => 'Bulk Contact (beta)',

            'url'  => 'bulk_contact',

            'can' => 'isManager'  ,

        ],

    ],

],




['text'    => 'Mol Cargo deliveries',

'icon'    => 'fas fa-dolly-flatbed',

'can' => 'isManager'  ,

'submenu' => [

    [

        'text' => 'All tracking',

        'url'  => 'tracking_all',

        'can' => 'isManager'  ,

    ],
    [

        'text' => 'To invoice/validate',

        'url'  => 'to_inv_val',

        'can' => 'isManager'  ,

    ], 

],

],












['header' => 'HELPERS',
'can' => 'isManager' ,  
],

[

     'text'    => 'Spare Parts',

     'icon'    => 'fa fa-hammer',

     'can' => 'isManager'  ,

     'submenu' => [

         [
         
             'text' => 'Prepare imports',

             'url'  => 'sp/prepareimports',

             'can' => 'isManager'  ,

         ],



     ],

 ], 












 ['header' => 'FORMS',
 
],

 [

      'text'    => 'Delivery-Pickup',

      'icon'    => 'fas fa-chart-bar',



      'submenu' => [

          [

              'text' => 'Create',

              'url'  => '/del_pick',



          ],
          [

            'text' => 'List',

            'url'  => '/del_pick_list',



        ],
        [

            'text' => 'List Finalized',

            'url'  => '/del_pick_finished_list',



        ],


      ],

  ], 




























        ['header' => 'OFFICIAL STATISTICS',
        'can' => 'isManager' ,  
    ],

       [

            'text'    => 'Countries',

            'icon'    => 'fas fa-globe-africa',


            'can' => 'isManager'  ,

            'submenu' => [

                [

                    'text' => 'Netherlands',

                    'url'  => 'statnl',

                    'can' => 'isManager'  ,

                ],

                [

                    'text' => 'Belgium',

                    'url'  => 'statbe',

                    'can' => 'isManager'  ,

                ],

            ],

        ], 























		],



    /*

    |--------------------------------------------------------------------------

    | Menu Filters

    |--------------------------------------------------------------------------

    |

    | Here we can modify the menu filters of the admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#612-menu-filters

    |

    */



    'filters' => [

        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,

    ],



    /*

    |--------------------------------------------------------------------------

    | Plugins Initialization

    |--------------------------------------------------------------------------

    |

    | Here we can modify the plugins used inside the admin panel.

    |

    | For more detailed instructions you can look here:

    | https://github.com/jeroennoten/Laravel-AdminLTE/#613-plugins

    |

    */



    'plugins' => [

        'DateRangePicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.css',
                ],
            ],
        ],










        'Datatables' => [

            'active' => false,

            'files' => [

                [

                    'type' => 'js',

                    'asset' => false,

                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',

                ],

                [

                    'type' => 'js',

                    'asset' => false,

                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',

                ],

                [

                    'type' => 'css',

                    'asset' => false,

                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',

                ],

            ],

        ],








        'DatatablesPlugins' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
            ],
        ],




















        'Select2' => [

            'active' => false,

            'files' => [

                [

                    'type' => 'js',

                    'asset' => false,

                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',

                ],

                [

                    'type' => 'css',

                    'asset' => false,

                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',

                ],

            ],

        ],

        'Chartjs' => [

            'active' => false,

            'files' => [

                [

                    'type' => 'js',

                    'asset' => false,

                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',

                ],

            ],

        ],

        'Sweetalert2' => [

            'active' => false,

            'files' => [

                [

                    'type' => 'js',

                    'asset' => false,

                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',

                ],

            ],

        ],

        'Pace' => [

            'active' => false,

            'files' => [

                [

                    'type' => 'css',

                    'asset' => false,

                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',

                ],

                [

                    'type' => 'js',

                    'asset' => false,

                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',

                ],

            ],

        ],

    ],

];

