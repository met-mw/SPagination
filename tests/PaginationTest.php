<?php
use SPagination\Classes\Pagination;

class PaginationTest extends PHPUnit_Framework_TestCase
{

    public function testOutputData()
    {
        $Pagination = new Pagination();
        $Pagination->setCount(100)
            ->setCountOnPage(10);

        $this->assertEquals(10, $Pagination->getNumberOfPages());
        $this->assertEquals(0, $Pagination->getOffset());
        $this->assertEquals(10, $Pagination->getLimit());
    }

}