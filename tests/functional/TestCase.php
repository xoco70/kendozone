<?php


class TestCase extends BrowserKitTest
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://laravel.dev';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
//        putenv('DB_DEFAULT=mysql_test');

        $app = require __DIR__ . '/../../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();


        $this->baseUrl = env('URL_BASE', $this->baseUrl);
//        $this->baseUrl = (app()->environment()=='local' ? getenv('APP_BASE') : config('app.url'));
//        $this->baseUrl .= App::getLocale()."/";


        return $app;
    }
}
