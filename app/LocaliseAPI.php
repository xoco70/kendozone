<?php

namespace App;

use GuzzleHttp\Client;

class LocaliseAPI
{
    protected $apiKey;
    protected $projectId;
    protected $urlBase = "https://api.lokalise.co/api";

    /**
     * LocaliseAPI constructor.
     */
    public function __construct()
    {
        $this->apiKey = env('LOCALISE_API_KEY');
        $this->projectId = env('LOCALISE_PROJECT');
    }


    /**
     * Return all Langs in Localise
     * @return array
     */
    public function listLangsInProject()
    {
        try {
            $body = (new Client())
                ->request('GET', $this->urlBase . '/language/list?api_token=' . $this->apiKey . '&id=' . $this->projectId)
                ->getBody();
            return json_decode($body)->languages;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Send translations to to Localize.co
     * @return mixed
     */
    public function pullLangs()
    {
        $client = new Client(['verify' => false]);
        $response = $client->post('https://api.lokalise.co/api/project/export', [
            'multipart' => [
                [
                    'name' => 'api_token',
                    'contents' => $this->apiKey
                ],
                [
                    'name' => 'id',
                    'contents' => $this->projectId
                ],
                [
                    'name' => 'type',
                    'contents' => 'php'
                ],
                [
                    'name' => 'use_original',
                    'contents' => '1'
                ],
                [
                    'name' => 'export_empty',
                    'contents' => 'skip'
                ],
            ],
        ]);

        $body = $response->getBody();
        $details = json_decode($body);
        return $details->bundle->file;
    }
}