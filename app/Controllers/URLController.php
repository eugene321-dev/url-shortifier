<?php

namespace Controllers;

use DateTime;
use Models\URLRepository;

class URLController extends Controller
{
    private URLRepository $urlRepository;

    public function __construct(array $config, URLRepository $urlRepository)
    {
        parent::__construct($config);
        $this->urlRepository = $urlRepository;
    }

    public function index(): void
    {
        $urls = $this->urlRepository->get();
        $this->render('index', ['urls' => $urls]);
    }

    public function create(): void
    {
        $this->render('create', ['base_url' => $_SERVER['HTTP_HOST']]);
    }

    public function store(array $newUrlData): void
    {
        // На цьому етапі також варто додати якусь кастомну валідацію на наявність/валідність переданих параметрів
        $this->urlRepository->store($newUrlData['url'], $newUrlData['expiration_period']);
        header('Location: /');
    }

    public function redirect(string $code): void
    {
        $url = $this->urlRepository->find($code);
        if (!$url) {
            echo "Invalid or expired URL";
            exit(422);
        }

        $this->urlRepository->incrementViewsByKey($code);
        header('Location: ' . $url->url);
    }

}
