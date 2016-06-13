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
    protected $countOnPage = 10;
    protected $pageNumberParamName = 'page';
    protected $countOnPageParamName = 'on_page';

    protected $displayedPreviousCount = 5;
    protected $displayedNextCount = 5;

    /**
     * Pagination constructor.
     * @param int $displayedPreviousCount
     * @param int $displayedNextCount
     * @param string $pageNumberParamName
     * @param string $countOnPageParamName
     */
    public function __construct($displayedPreviousCount = 5, $displayedNextCount = 5, $pageNumberParamName = 'page', $countOnPageParamName = 'on_page')
    {
        $this->setDisplayedLinksRange($displayedPreviousCount, $displayedNextCount)
            ->setPageNumberParamName($pageNumberParamName)
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
        return $this->countOnPage * ($this->currentPageNumber - 1);
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
        ?><ul class="pagination"><?php
            ?><li<?php if ($this->currentPageNumber == 1) { ?> class="disabled"<?php } ?>><?php
                ?><a href="?<?php echo $this->pageNumberParamName; ?>=1&amp;<?php echo $this->countOnPageParamName; ?>=<?php echo $this->countOnPage; ?>" aria-label="First"><?php
                    ?><span aria-hidden="true">&laquo;&laquo;</span><?php
                ?></a><?php
            ?></li><?php
            ?><li<?php if ($this->currentPageNumber == 1) { ?> class="disabled"<?php } ?>><?php
                ?><a href="?<?php echo $this->pageNumberParamName; ?>=<?php echo ($this->currentPageNumber == 1 ? 1 : $this->currentPageNumber - 1); ?>&amp;<?php echo $this->countOnPageParamName; ?>=<?php echo $this->countOnPage; ?>" aria-label="Previous"><?php
                    ?><span aria-hidden="true">&laquo;</span><?php
                ?></a><?php
            ?></li><?php

            $numberOfPages = $this->getNumberOfPages();
            $previousAndCurrentDiff = $this->currentPageNumber - $this->displayedPreviousCount;
            $nextAndCurrentDiff = $this->currentPageNumber + $this->displayedNextCount;

            $needPreviousEllipsis = $previousAndCurrentDiff >= 2;
            $needNextEllipsis = $nextAndCurrentDiff <= $numberOfPages - 1;

            if ($needPreviousEllipsis) {
                ?><li>...</li><?php
            }

            for ($i = 1; $i <= $numberOfPages; $i++) {
                if ($i < $this->currentPageNumber) {
                    if ($i >= $previousAndCurrentDiff) {
                        ?><li><?php
                            ?><a href="?<?php echo $this->pageNumberParamName; ?>=<?php echo $i; ?>&amp;<?php echo $this->countOnPageParamName; ?>=<?php echo $this->countOnPage; ?>"><?php echo $i; ?></a><?php
                        ?></li><?php
                    }
                } elseif ($i > $this->currentPageNumber) {
                    if ($i <= $nextAndCurrentDiff) {
                        ?><li><?php
                            ?><a href="?<?php echo $this->pageNumberParamName; ?>=<?php echo $i; ?>&amp;<?php echo $this->countOnPageParamName; ?>=<?php echo $this->countOnPage; ?>"><?php echo $i; ?></a><?php
                        ?></li><?php
                    }
                } else {
                    ?><li class="active"><?php
                        ?><a href="?<?php echo $this->pageNumberParamName; ?>=<?php echo $i; ?>&amp;<?php echo $this->countOnPageParamName; ?>=<?php echo $this->countOnPage; ?>"><?php echo $i; ?></a><?php
                    ?></li><?php
                }
            }

            if ($needNextEllipsis) {
                ?><li>...</li><?php
            }

            ?><li<?php if ($this->currentPageNumber == $numberOfPages) { ?> class="disabled"<?php } ?>><?php
                ?><a href="?<?php echo $this->pageNumberParamName; ?>=<?php echo ($this->currentPageNumber == $numberOfPages ? $numberOfPages : $this->currentPageNumber + 1); ?>&amp;<?php echo $this->countOnPageParamName; ?>=<?php echo $this->countOnPage; ?>" aria-label="Next"><?php
                    ?><span aria-hidden="true">&raquo;</span><?php
                ?></a><?php
            ?></li><?php
            ?><li<?php if ($this->currentPageNumber == $numberOfPages) { ?> class="disabled"<?php } ?>><?php
                ?><a href="?<?php echo $this->pageNumberParamName; ?>=<?php echo $numberOfPages; ?>&amp;<?php echo $this->countOnPageParamName; ?>=<?php echo $this->countOnPage; ?>" aria-label="Last"><?php
                    ?><span aria-hidden="true">&raquo;&raquo;</span><?php
                ?></a><?php
            ?></li><?php
        ?></ul><?php
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
     * @param int $previousCount
     * @param int $nextCount
     * @return InterfacePagination
     */
    public function setDisplayedLinksRange($previousCount, $nextCount)
    {
        if (!is_integer($previousCount)) {
            throw new InvalidArgumentException('Количество отображаемых ссылок на предыдущие страницы должно быть целым числом.');
        }

        if (!is_integer($nextCount)) {
            throw new InvalidArgumentException('Количество отображаемых ссылок на следующие страницы должно быть целым числом.');
        }

        $this->displayedPreviousCount = $previousCount;
        $this->displayedNextCount = $nextCount;
        return $this;
    }

}