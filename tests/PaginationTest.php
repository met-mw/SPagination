<?php
use SPagination\Classes\Pagination;

class PaginationTest extends PHPUnit_Framework_TestCase
{

    public function testOffset()
    {
        $Pagination = new Pagination();
        $Pagination->setCount(100)
            ->setCountOnPage(10);
        $this->assertEquals(0, $Pagination->getOffset());
        $Pagination->setCurrentPageNumber(5);
        $this->assertEquals(40, $Pagination->getOffset());

        $Pagination = new Pagination();
        $Pagination->setCount(10)
            ->setCountOnPage(3);
        $this->assertEquals(0, $Pagination->getOffset());
        $Pagination->setCurrentPageNumber(4);
        $this->assertEquals(9, $Pagination->getOffset());
    }

    public function testPagesCount()
    {
        $Pagination = new Pagination();
        $Pagination->setCount(100)
            ->setCountOnPage(10);
        $this->assertEquals(10, $Pagination->getNumberOfPages());

        $Pagination = new Pagination();
        $Pagination->setCount(10)
            ->setCountOnPage(3);
        $this->assertEquals(4, $Pagination->getNumberOfPages());
    }

    public function testSettings()
    {
        $Pagination = new Pagination();
        $this->assertEquals($Pagination, $Pagination->setCount(10));
        $this->assertEquals($Pagination, $Pagination->setCountOnPage(10));
        $this->assertEquals($Pagination, $Pagination->setCurrentPageNumber(1));
        $this->assertEquals($Pagination, $Pagination->setCountOnPageParamName());
        $this->assertEquals($Pagination, $Pagination->setPageNumberParamName());
        $this->assertEquals($Pagination, $Pagination->setDisplayedLinksRange(1, 1));
    }

    public function testRender()
    {
        $Pagination = new Pagination();
        $Pagination->setCount(100)
            ->setCountOnPage(10)
            ->setDisplayedLinksRange(1, 1)
            ->setCurrentPageNumber(5);

        $DOMDocument = new DOMDocument();
        $DOMDocument->validateOnParse = false;
        $DOMDocument->loadHTML($Pagination->get());
        $ul = $DOMDocument->getElementsByTagName('ul')->item(0);
        $this->assertEquals('ul', $ul->localName);
        $this->assertEquals(9, $ul->childNodes->length);
    }

}