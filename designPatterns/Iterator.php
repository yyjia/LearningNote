<?php
  /**
   * 让对象变得可迭代并表现得像对象集合
   */
  class Book
  {
    private $title;

    private $author;

    public function __construct(string $title, string $author)
    {
      $this->title = $title;
      $this->author = $author;
    }

    public function getTitleAndAuthor():string
    {
      return $this->title."by".$this->author;
    }
  }

  /**
   *  Bool迭代器类
   */
  class BookList implements \Countable, \Iterator
  {

    private $books = [];

    private $currentIndex = 0;
    function addBook(Book $book)
    {
      $this->books[] = $book;
    }

    public function rewind()
    {
      $this->currentIndex = 0;
    }

    public function count(): int
    {
      return count($this->books);
    }

    public function key()
    {
      echo 'current key is :' . $this->currentIndex . "\n";
    }

    public function next()
    {
      $this->currentIndex++;
    }

    public function current()
    {
      return $this->books[$this->currentIndex];
    }

    public function valid(): bool
    {
      return isset($this->books[$this->currentIndex]);
    }

    public function removeBook(Book $cutBook)
    {
      foreach ($this->books as $key => $book) {
        if ($book->getTitleAndAuthor() === $cutBook->getTitleAndAuthor()){
          unset($this->books[$key]);
        }
      }

      $this->books = array_values($this->books);
    }
  }

  $bookList = new BookList();
  $bookList->addBook(new Book("<<美丽的世界>>", 'lining'));
  $bookList->addBook(new Book("<<钢铁是咋样练成的>>", 'austolofj'));
  echo "current num is ::".$bookList->count()."\n";
  $bookList->key();
  $bookList->next();
  $bookList->key();
?>
