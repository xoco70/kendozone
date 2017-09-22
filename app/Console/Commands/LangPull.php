<?php

namespace App\Console\Commands;

use App\LocaliseAPI;
use File;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
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
        $api = new LocaliseAPI();
        $file = $api->pullLangs();

        $savepath = './resources/lang/';
        $remotefile = 'https://lokalise.co/' . $file;
        $newfile = './storage/tmp_file.zip';

        if (!copy($remotefile, $newfile)) {
            echo "failed to copy $remotefile...\n";
            exit;
        }

        $this->unzipTranslations($newfile, $savepath);
    }


    /**
     * Delete a folder and his content
     * @param $dir
     */
    private function rmdir_recursive($dir) {
        foreach(scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file")) $this->rmdir_recursive("$dir/$file");
            else unlink("$dir/$file");
        }
        rmdir($dir);
    }

    /**
     * @param $newfile
     * @param $savepath
     */
    protected function unzipTranslations($newfile, $savepath)
    {
        $zip = new ZipArchive;
        if ($zip->open($newfile) === true) {
            $zip->extractTo($savepath);
            $zip->close();
            File::copyDirectory("./resources/lang/es_ES/", "./resources/lang/es/");
            $this->rmdir_recursive("./resources/lang/es_ES/");
            echo "ok";
        } else {
            echo 'failed';
        }
        unlink($newfile);
    }
}
