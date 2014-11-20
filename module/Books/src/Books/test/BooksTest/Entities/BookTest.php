<?php

namespace BooksTest\Entities;

use Books\Entities\Book;
use PHPUnit_Framework_TestCase;

/**
 * Description of BookTest
 *
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
class BookTest extends PHPUnit_Framework_TestCase {

    protected $fixture;
    
    public function setUp() {
        parent::setUp();
        $this->fixture = new Book;
    }
    
    public function testInitialState() {
        $this->assertInstanceOf('\Books\Entities\Book', $this->fixture, 'fixture should be an instance of Books\Entities\Book...');
        $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $this->fixture->getAuthors(), 'should be an instance of doctrine array collection...');
        $this->assertEquals(0, $this->fixture->getAuthors()->count(), 'authors collection should contain zero elements...');
    }
    
    public function testSample() {
        $this->markTestIncomplete(__METHOD__);
    }
}
