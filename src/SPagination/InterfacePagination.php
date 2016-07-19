<?php
namespace SPagination;


interface InterfacePagination
{

    /**
     * @return int
     */
    public function getCount();

    /**
     * @return int
     */
    public function getLimit();

    /**
     * @return int
     */
    public function getOffset();

    /**
     * @return int
     */
    public function getNumberOfPages();

    /**
     * @param int $count
     * @return $this
     */
    public function setCount($count);

    /**
     * @param int $pageNumber
     * @return $this
     */
    public function setCurrentPageNumber($pageNumber);

    /**
     * @param int $countOnPage
     * @return $this
     */
    public function setCountOnPage($countOnPage);

    /**
     * @param string $pageNumberParamName
     * @return $this
     */
    public function setPageNumberParamName($pageNumberParamName = 'page');

    /**
     * @param string $countOnPageParamName
     * @return $this
     */
    public function setCountOnPageParamName($countOnPageParamName = 'on-page');

    /**
     * @param int $previousCount
     * @param int $nextCount
     * @return $this
     */
    public function setDisplayedLinksRange($previousCount, $nextCount);

    /**
     * @return string
     */
    public function get();
    public function render();

}