<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class LangPush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:push';

    protected $apikey;
    protected $project;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send translations to lokalise.co';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->apikey = env('LOCALISE_API_KEY');
        $this->project = env('LOCALISE_PROJECT');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client(['verify' => false]);
        $file = file_get_contents('./resources/lang/en/app.php');
        $response = $client->request('POST', 'https://api.lokalise.co/api/project/import', [
            'multipart' => [
                [
                    'name' => 'api_token',
                    'contents' => $this->apikey
                ],
                [
                    'name' => 'id',
                    'contents' => $this->project
                ],
                [
                    'name' => 'replace',
                    'contents' => '1'
                ],
                [
                    'name' => 'lang_iso',
                    'contents' => 'en'
                ],
                [
                    'name' => 'file',
                    'contents' => $file,
                    'filename' => 'app.php',
                ]
            ]]);
        $body = $response->getBody();

        echo $body;

    }
}
