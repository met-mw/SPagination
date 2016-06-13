<?php
namespace SPagination\Interfaces;


interface InterfacePagination
{

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
     * @return InterfacePagination
     */
    public function setCount($count);

    /**
     * @param int $pageNumber
     * @return InterfacePagination
     */
    public function setCurrentPageNumber($pageNumber);

    /**
     * @param int $countOnPage
     * @return InterfacePagination
     */
    public function setCountOnPage($countOnPage);

    /**
     * @param string $pageNumberParamName
     * @return InterfacePagination
     */
    public function setPageNumberParamName($pageNumberParamName = 'page');

    /**
     * @param string $countOnPageParamName
     * @return InterfacePagination
     */
    public function setCountOnPageParamName($countOnPageParamName = 'on_page');

    /**
     * @param int $displayedLinksCount
     * @return InterfacePagination
     */
    public function setDisplayedLinksCount($displayedLinksCount);

    /**
     * @return string
     */
    public function get();
    public function render();

}