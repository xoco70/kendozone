<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Config;
use ZipArchive;

class LangPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:pull';

    protected $apikey;
    protected $project;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://lokali.se/api/project/export', [
            'multipart' => [
                [
                    'name'     => 'api_token',
                    'contents' => $this->apikey
                ],
                [
                    'name'     => 'id',
                    'contents' => $this->project
                ],
                [
                    'name'     => 'type',
                    'contents' => 'php'
                ],
                [
                    'name'     => 'export_empty',
                    'contents' => 'base'
                ],
            ],
            'verify' => './resources/assets/cacert.pem',
        ]);

        $body = $response->getBody();
        $details = json_decode($body);
        $file = $details->bundle->file;

        $languages = Config::get('app.site_lang');
        $savepath = './resources/lang/';

        $remotefile = 'https://lokali.se/'.$file;
        $newfile = './storage/tmp_file.zip';

        if (!copy($remotefile, $newfile)) {
            echo "failed to copy $remotefile...\n";
            exit;
        }

        $zip = new ZipArchive;
        if ($zip->open($newfile) === true) {
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $zipfilename = strtolower(basename($zip->getNameIndex($i), ".php"));

                if ($zipfilename === 'en') {
                    continue;
                }

                if ($zipfilename === 'es_es') {
                    $zipfilename = 'es';
                }

                if (array_key_exists($zipfilename, $languages)) {
                    $fp = $zip->getStream($zip->getNameIndex($i));
                    if (!$fp) {
                        exit("failed\n");
                    }
                    $contents = '';
                    while (!feof($fp)) {
                        $contents .= fread($fp, 2);
                    }
                    $newpath = $savepath.$zipfilename.'/app.php';
                    echo $newpath."\r\n";
                    fclose($fp);
                    file_put_contents($newpath, $contents);
                }

            }
            echo 'ok';
        } else {
            echo 'failed';
        }
        unlink($newfile);
    }
}
