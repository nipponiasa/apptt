<?php

return [
    'odoo' => [
       // 'production_url' => 'https://alpiek-oisterwijk-traden-and-traffic-modules.odoo.com' ,
       'production_url' => env('ODOO_PRODUCTION_URL','default'),
       // 'production_db' => 'alpiek-oisterwijk-traden-and-traffic-modules-13-0-874478',
       'production_db' => env('ODOO_PRODUCTION_DB','default'),
       //'dev_url' => 'https://testodoo.trade-traffic.com',
       'dev_url' =>  env('ODOO_TEST_URL','default'),
      // 'dev_db' => 'alpiek-oisterwijk-traden-and-traffic-modules-13-0-te-1303822',
       'dev_db' =>  env('ODOO_TEST_DB','default'),
      // 'user' => 'vgorgolis@nipponia.com',
       'user' =>  env('ODOO_USER','default'),
     // 'pass' => '1234$#@!',
       'pass' =>  env('ODOO_PASS','default'),
      //'production_url' => env('ODOO_TEST_URL','default'),
     // 'production_db' => env('ODOO_TEST_DB','default'),


    ]
];