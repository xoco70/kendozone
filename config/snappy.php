<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => env('WKHTMLTOPDF_PATH','/usr/bin/wkhtmltopdf'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => env('WKHTMLTOIMAGE_PATH','/usr/bin/wkhtmltoimage'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
