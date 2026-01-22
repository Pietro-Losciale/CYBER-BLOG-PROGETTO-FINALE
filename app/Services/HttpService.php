<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

//codice da chatGPT
use Illuminate\Support\Facades\Auth;
//-----------------//

class HttpService
{
    protected $client;
    protected $allowedDomains = ['internal.finance','newsapi.org'];
    protected $allowedProtocols = ['http', 'https'];
    protected $refererHeader; // Intestazione Referer

    public function __construct()
    {
        $this->refererHeader = config('app.url');
        $this->client = new Client();
    }

    public function getRequest($url)
    {
        $parsedUrl = parse_url($url);

        //CODICE DA CHATGPT
        // Controllo ruolo: solo admin possono accedere a internal.finance
       if (
        isset($parsedUrl['host']) &&
        $parsedUrl['host'] === 'internal.finance' &&
        (!Auth::check() || !Auth::user()->is_admin)
          ) {
        return 'Unauthorized internal request';
          }
       //------------//








        // Validate protocol
        if (!in_array($parsedUrl['scheme'], $this->allowedProtocols)) {
            return 'Protocol not allowed';
        }
       
        // Validate domain
        if (!isset($parsedUrl['host']) || !in_array($parsedUrl['host'], $this->allowedDomains)) {
            return 'Domain not allowed';
        }

        // Aggiungi l'intestazione Referer per le richieste al server locale
        $options['headers'] = ['Referer' => $this->refererHeader];

        try {
            $response = $this->client->request('GET', $url, $options);
            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            return 'Something went wrong: ' . $e->getMessage();
        }
    }
}
