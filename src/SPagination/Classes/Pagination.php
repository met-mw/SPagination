<?php
namespace SPagination\Classes;


use InvalidArgumentException;
use SPagination\Interfaces\InterfacePagination;

class Pagination implements InterfacePagination
{

    /** @var int */
    protected $count;
    /** @var int */
    protected $currentPageNumber = 1;
    /** @var int */
    protected $countOnPage;
    protected $pageNumberParamName;
    protected $countOnPageParamName;
    protected $displayedLinksCount = 5;

    public function __construct($pageNumberParamName = 'page', $countOnPageParamName = 'on_page')
    {
        $this->setPageNumberParamName($pageNumberParamName)
            ->setCountOnPageParamName($countOnPageParamName);
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->countOnPage;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->countOnPage * ($this->displayedLinksCount - 1);
    }

    /**
     * @return int
     */
    public function getNumberOfPages()
    {
        return (int)ceil($this->count / $this->countOnPage);
    }

    /**
     * @param int $count
     * @return InterfacePagination
     */
    public function setCount($count)
    {
        if (!is_integer($count)) {
            throw new InvalidArgumentException('Количество элементов должно быть целым числом.');
        }

        $this->count = $count;
        return $this;
    }

    /**
     * @param int $pageNumber
     * @return InterfacePagination
     */
    public function setCurrentPageNumber($pageNumber = 1)
    {
        if (!is_integer($pageNumber)) {
            throw new InvalidArgumentException('Номер текущий страницы должен быть целым числом.');
        }

        $this->currentPageNumber = $pageNumber == 0 ? 1 : $pageNumber;
        return $this;
    }

    /**
     * @param int $countOnPage
     * @return InterfacePagination
     */
    public function setCountOnPage($countOnPage)
    {
        if (!is_integer($countOnPage)) {
            throw new InvalidArgumentException('Количество элементов на странице должно быть целым числом.');
        }

        $this->countOnPage = $countOnPage;
        return $this;
    }

    /**
     * @return string
     */
    public function get()
    {
        ob_start();
        $this->render();
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function render()
    {
        ?><nav><?
            ?><ul><?
                ?><li<? if ($this->currentPageNumber == 1) { ?> class="disabled"<? } ?>><?
                    ?><a href="?page=1" aria-label="First"><?
                        ?><span aria-hidden="true">&laquo;&laquo;</span><?
                    ?></a><?
                ?></li><?
                ?><li<? if ($this->currentPageNumber == 1) { ?> class="disabled"<? } ?>><?
                    ?><a href="#" aria-label="Previous"><?
                        ?><span aria-hidden="true">&laquo;</span><?
                    ?></a><?
                ?></li><?
                $numberOfPages = $this->getNumberOfPages();
                for ($i = 1; $i <= $numberOfPages; $i++) {
                    ?><li<? if ($this->currentPageNumber == $i) { ?> class="active"<? } ?>><?
                        ?><a href="?page=<?= $i ?>&on_page=<?= $this->countOnPage ?>"><?= $i ?></a><?
                    ?></li><?
                }
                ?><li<? if ($this->currentPageNumber == $numberOfPages) { ?> class="disabled"<? } ?>><?
                    ?><a href="#" aria-label="Next"><?
                        ?><span aria-hidden="true">&raquo;</span><?
                    ?></a><?
                ?></li><?
                ?><li<? if ($this->currentPageNumber == $numberOfPages) { ?> class="disabled"<? } ?>><?
                    ?><a href="?page=<?= $numberOfPages ?>" aria-label="Last"><?
                        ?><span aria-hidden="true">&raquo;&raquo;</span><?
                    ?></a><?
                ?></li><?
            ?></ul><?
        ?></nav><?
    }

    /**
     * @param string $pageNumberParamName
     * @return InterfacePagination
     */
    public function setPageNumberParamName($pageNumberParamName = 'page')
    {
        if (!is_string($pageNumberParamName)) {
            throw new InvalidArgumentException('Имя параметра номера страницы должно быть строкой.');
        }

        $this->pageNumberParamName = $pageNumberParamName;
        return $this;
    }

    /**
     * @param string $countOnPageParamName
     * @return InterfacePagination
     */
    public function setCountOnPageParamName($countOnPageParamName = 'on_page')
    {
        if (!is_string($countOnPageParamName)) {
            throw new InvalidArgumentException('Имя параметра количества элементов на странице должно быть строкой.');
        }

        $this->countOnPageParamName = $countOnPageParamName;
        return $this;
    }

    /**
     * @param int $displayedLinksCount
     * @return InterfacePagination
     */
    public function setDisplayedLinksCount($displayedLinksCount)
    {
        if (!is_integer($displayedLinksCount)) {
            throw new InvalidArgumentException('Количество отображаемых ссылок на страницы должно быть целым числом.');
        }

        $this->displayedLinksCount = $displayedLinksCount;
        return $this;
    }

}