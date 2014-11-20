<?php

namespace Books\Entities;

/**
 * Description of Rating
 *
 * @Entity(repositoryClass="Books\Repositories\AuthorRepository")
 * @Table(name="bk_ratings")
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
class Rating {

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
    protected $reader;
    
    /**
     * @Column(type="smallint", nullable=false)
     * @var int
     */
    protected $rating;
    
    /**
     * @ManyToOne(targetEntity="Books\Entities\Book", fetch="LAZY")
     * @JoinColumn(name="bk_books_id", referencedColumnName="id")
     * @var Book 
     */
    protected $book;
    
    public function getId() {
        return $this->id;
    }

    public function getReader() {
        return $this->reader;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getBook() {
        return $this->book;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setReader($reader) {
        $this->reader = $reader;
        return $this;
    }

    public function setRating($rating) {
        $this->rating = $rating;
        return $this;
    }

    public function setBook(Book $book) {
        $this->book = $book;
        return $this;
    }
    
}
