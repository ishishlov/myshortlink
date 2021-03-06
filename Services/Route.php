<?php

namespace Services;

require_once 'Views\Html\Blocks\Form.php';
require_once 'Views\Html\Blocks\PageNotFound.php';
require_once 'Views\Html\Index.php';
require_once 'Services\OriginalLink.php';
require_once 'Services\MyShortLink.php';
require_once 'Services\Redirection.php';

use Models\ShortLinkStorage;
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
        if (isset($_POST['link'])) {
            $link = OriginalLink::create($_POST['link']);
            MyShortLink::createTokenAndShowShortLink($link, new ShortLinkStorage());
        }

        if ($this->isIndexPage()) {
            Index::render(Form::create());
        }

        if ($this->isPageNotFound()) {
            Index::render(PageNotFound::create());
        }

        Redirection::getLinkAndRedirect($this->param, new ShortLinkStorage());
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
