<?php

namespace Services;

require_once 'Views\Blocks\Form.php';
require_once 'Views\Blocks\PageNotFound.php';
require_once 'Views\Index.php';
require_once 'Services\OriginalLink.php';
require_once 'Services\MyShortLink.php';
require_once 'Services\Redirection.php';

use Views\Blocks\Form;
use Views\Blocks\PageNotFound;
use Views\Index;

class Route
{
    private const PARAM_SIZE = 6;

    private $url;
    private $urlArray;
    private $param;

    public function __construct(?string $url)
    {
        $this->url = trim($url);
        $this->urlArray = explode('/', $this->url);
        $this->param = trim($this->urlArray[1]);
    }

    public function routing(): void
    {
        if (isset($_POST['link'])) {
            $link = OriginalLink::create($_POST['link']);
            MyShortLink::createTokenAndShowShortLink($link);
        }

        if ($this->isIndexPage()) {
            Index::render(Form::getHtml());
        }

        if ($this->isPageNotFound()) {
            Index::render(PageNotFound::getHtml());
        }

        Redirection::getLinkAndRedirect($this->getParam());
    }

    public function isIndexPage(): bool
    {
        return !$this->url  || $this->url  === '/' || $this->url  === 'index' || $this->url === 'index.php';
    }

    public function isPageNotFound(): bool
    {
        if (count($this->urlArray) > 2) {
            return true;
        }

        $param = trim($this->urlArray[1]);

        return mb_strlen($param) != self::PARAM_SIZE;
    }

    public function getParam(): string
    {
        return $this->param;
    }
}
