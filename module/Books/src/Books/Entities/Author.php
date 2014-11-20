<?php

namespace Books\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Author
 *
 * @Entity(repositoryClass="Books\Repositories\AuthorRepository")
 * @Table(name="bk_authors")
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
class Author {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     * @var int
     */
    protected $id;
    
    /**
     * @Column(type="string", length=30)
     * @var string
     */
    protected $firstname;
    
    /**
     * @Column(type="string", length=30)
     * @var string
     */
    protected $lastname;
    
    /**
     *
     * @ManyToMany(targetEntity="Books\Entities\Book", mappedBy="authors", cascade={"persist"})
     * @var Book 
     */
    protected $books;
    
    public function __construct() {
        $this->books = new ArrayCollection;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getBooks() {
        return $this->books;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setBooks($books) {
        $this->books = $books;
        return $this;
    }
    
}
