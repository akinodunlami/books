<?php

namespace Books\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Validator\Isbn;

/**
 * Description of Book
 *
 * @HasLifecycleCallbacks
 * @Entity(repositoryClass="Books\Repositories\BookRepository")
 * @Table(name="bk_books")
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
class Book {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     * @var int
     */
    protected $id;
    
    /**
     * @Column(type="string", length=50, nullable=false)
     * @var string
     */    
    protected $isbn;
    
    /**
     * @Column(type="string", length=10)
     * @var string
     */    
    protected $rating;
    
    /**
     * @Column(type="string", length=100, nullable=false)
     * @var string
     */    
    protected $title;
    
    /**
     * @Column(type="datetime", name="date_published", nullable=false)
     * @var DateTime
     */    
    protected $datePublished;
    
    /**
     * @ManyToMany(targetEntity="Books\Entities\Author", inversedBy="books", indexBy="id")
     * @JoinTable(name="bk_book_authors", joinColumns={@JoinColumn(name="bk_authors_id", referencedColumnName="id")}, 
     * inverseJoinColumns={@JoinColumn(name="bk_books_id", referencedColumnName="id")})
     * @var Author 
     */
    protected $authors;

    /**
     * @PrePersist
     * @PreUpdate
     */
    public function validate() {
        
        $isbnValidator = new Isbn;
        
        if ( ! $isbnValidator->isValid($this->isbn) ) {
            throw new \Exception(sprintf('%s expects book entity to have a valid isbn...', __METHOD__));
        }
        
        if ( ! $this->datePublished instanceof DateTime ) {
            throw new \Exception(sprintf('%s expects book entity to have a published date...', __METHOD__));            
        }
        
    }
    
    public function __construct() {
        $this->authors      = new ArrayCollection;
    }

    public function getId() {
        return $this->id;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDatePublished() {
        return $this->datePublished;
    }

    public function getAuthors() {
        return $this->authors;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
        return $this;
    }

    public function setRating($rating) {
        $this->rating = $rating;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setDatePublished(DateTime $datePublished) {
        $this->datePublished = $datePublished;
        return $this;
    }

    public function setAuthors($authors) {
        $this->authors = $authors;
        return $this;
    }

}
