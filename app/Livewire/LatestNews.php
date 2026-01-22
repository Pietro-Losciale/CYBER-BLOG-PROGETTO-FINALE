<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use App\Services\HttpService;

class LatestNews extends Component
{
    public $selectedApi;
    public $news;
    protected $httpService;

    public function __construct()
    {
        $this->httpService = app(HttpService::class);
    }



    // CODICE VECCHIO: INSICURO



    // public function fetchNews()
    // {
    //     if (filter_var($this->selectedApi, FILTER_VALIDATE_URL) === FALSE) {
    //         $this->news = 'Invalid URL';
    //         return;
    //     }

    //     $this->news = json_decode($this->httpService->getRequest($this->selectedApi), true);

    // }

    //---------------------------------------//



    //CODICE SICURO- DA CHATGPT


    public function fetchNews()
{
    // 1. Deve essere un URL valido
    if (filter_var($this->selectedApi, FILTER_VALIDATE_URL) === FALSE) {
        $this->news = 'Invalid URL';
        return;
    }

    // 2. Whitelist: accettiamo SOLO NewsAPI
    $allowedHost = 'newsapi.org';
    $parsedUrl = parse_url($this->selectedApi);

    if (!isset($parsedUrl['host']) || $parsedUrl['host'] !== $allowedHost) {
        $this->news = 'Unauthorized API endpoint';
        return;
    }

    // 3. Chiamata consentita
    $this->news = json_decode(
        $this->httpService->getRequest($this->selectedApi),
        true
    );
}

    //-----//
    public function render()
    {
        return view('livewire.latest-news');
    }
}