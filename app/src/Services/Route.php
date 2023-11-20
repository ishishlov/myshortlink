<?php

namespace App\Services;

use Exception;
use Views\html\blocks\Errors;
use Views\Html\Blocks\Form;
use Views\Html\Blocks\PageNotFound;
use Views\Html\Index;

class Route
{
    private const PARAM_SIZE = 6;

    private $url;
    private $urlArray;
    private $param;

    private function __construct(?string $url)
    {
        $this->url = trim($url);
        $this->urlArray = explode('/', $this->url);
        $this->param = trim($this->urlArray[1]);
    }

    public static function create(?string $url): self
    {
        return new self($url);
    }

    public function routing(): void
    {
        try {
            $config = new \Config\Storage();
            $storageConfig = ConfigFactory::create($config->getType());
            $storage = StorageFactory::create($config->getType(), $storageConfig);
        } catch (Exception $e) {
            Index::render(
                Form::create(),
                Errors::create($e->getMessage())
            );
        }

        if (isset($_POST['link'])) {
            $link = OriginalLink::create($_POST['link']);
            MyShortLink::createTokenAndShowShortLink($link, $storage);
        }

        if ($this->isIndexPage()) {
            Index::render(Form::create());
        }

        if ($this->isPageNotFound()) {
            Index::render(PageNotFound::create());
        }

        Redirection::getLinkAndRedirect($this->param, $storage);
    }

    private function isIndexPage(): bool
    {
        return !$this->url  || $this->url  === '/' || $this->url  === 'index' || $this->url === 'index.php';
    }

    private function isPageNotFound(): bool
    {
        if (count($this->urlArray) > 2) {
            return true;
        }

        return mb_strlen($this->param) != self::PARAM_SIZE;
    }
}
