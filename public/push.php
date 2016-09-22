<?php
`git pull`;
`composer install --no-interaction`;
`php artisan migrate`;
`php artisan route:cache`;
`php artisan config:cache`;
`php artisan clear-compiled`;
`php artisan optimize`;
`composer dump-autoload -o`;


