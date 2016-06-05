<?php
namespace SPagination\Classes;


use SPagination\Interfaces\InterfacePagination;

class Pagination implements InterfacePagination
{

    /** @var int */
    protected $count;
    /** @var int */
    protected $currentPageNumber;
    /** @var int */
    protected $countOnPage;
    protected $pageNumberParamName;
    protected $countOnPageParamName;

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
        return (int)$this->countOnPage;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return (int)$this->countOnPage * ((int)$this->currentPageNumber == 0 ? (int)$this->currentPageNumber : (int)$this->currentPageNumber - 1);
    }

    /**
     * @return int
     */
    public function getNumberOfPages()
    {
        return ceil($this->count / $this->countOnPage);
    }

    /**
     * @param int $count
     * @return InterfacePagination
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @param int $pageNumber
     * @return InterfacePagination
     */
    public function setCurrentPageNumber($pageNumber)
    {
        $this->currentPageNumber = $pageNumber == 0 ? 1 : $pageNumber;
        return $this;
    }

    /**
     * @param int $countOnPage
     * @return InterfacePagination
     */
    public function setCountOnPage($countOnPage)
    {
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
                    ?><a href="#" aria-label="Previous"><?
                        ?><span aria-hidden="true">&laquo;</span><?
                    ?></a><?
                ?></li><?
                $numberOfPages = $this->getNumberOfPages();
                for ($i = 1; $i < $numberOfPages + 1; $i++) {
                    ?><li<? if ($this->currentPageNumber == $i) { ?> class="active"<? } ?>><?
                        ?><a href="?page=<?= $i ?>&on_page=<?= $this->countOnPage ?>"><?= $i ?></a><?
                    ?></li><?
                }
                ?><li<? if ($this->currentPageNumber == $numberOfPages) { ?> class="disabled"<? } ?>><?
                    ?><a href="#" aria-label="Next"><?
                        ?><span aria-hidden="true">&raquo;</span><?
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
        $this->pageNumberParamName = $pageNumberParamName;
        return $this;
    }

    /**
     * @param string $countOnPageParamName
     * @return InterfacePagination
     */
    public function setCountOnPageParamName($countOnPageParamName = 'on_page')
    {
        $this->countOnPageParamName = $countOnPageParamName;
        return $this;
    }

}