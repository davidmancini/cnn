<?php
require_once(dirname(__DIR__) . "/lib/validate-date.php");

/*
 * Article
 *
 * Article is the actual content of a news article, including title, description, and content (copy)
 * Article does not contain any media or media ids; the link to media is located in articleMedia.
 *
 * @author David Mancini <mancini.david@gmail.com>
 */
class Article {

	/*
	 * id is primary key
	 * @var int articleId
	 */
	private $articleId;

	/*
	 * author id a foreign key from the author class
	 * @var int authorId
	 */
	private $authorId;

	/*
	 * title is the article title
	 * @var string title
	 */
	private $title;

	/*
	 * description is the short description of an article, limited to 128 characters.
	 * @var string description
	 */
	private $description;

	/*
	 * copy is the actual article content, limited to 10,000 characters.
	 * @var string copy
	 */
	private $copy;

	/*
	 * published time is the (auto-generated) time that the article is first saved
	 * @var  DateTime value of published time
	 */
	private $publishedTime;

	/*
	 * updated time is the (auto-generated) time that the article was last saved
	 * @var DateTime value of time last saved
	 */
	private $updatedTime;

	/*
	 * Accessor method for article id
	 * @return int value of article id
	 */
	public function getArticleId(){
		return($this->articleId);
	}

	/*
	 * Mutator method for article id
	 * @param int $newArticleId of new article id
	 * @throws InvalidArgumentException if article id is not an integer
	 * @throws RangeException if article id is negative
	 */
	public function setArticleId($newArticleId) {

		//filter
		$newArticleId = filter_var($newArticleId,FILTER_VALIDATE_INT);

		//Exception if not int
		if($newArticleId === false) {
			throw(new InvalidArgumentException("article id is not an integer"));
		}

		//Exception if not in range
		if($newArticleId <= 0){
			throw(new RangeException("article id must be positive"));
		}

		//save the object
		$this->articleId = $newArticleId;
	}

	/*
	 * Accessor method for author id
	 * @return int value of author id
	 */
	public function getAuthorId() {
		return $this->authorId;
	}

	/*
	 * Mutator for author id
	 * @param int $newAuthorId new value of author id
	 * @throws InvalidArgumentException if author id is not an integer
	 * @throws RangeException if author id is negative
	 */
	public function setAuthorId($newAuthorId) {
		$newAuthorId = filter_var($newAuthorId, FILTER_VALIDATE_INT);

		//Exception if author id is not an integer
		if($newAuthorId === false) {
			throw (new InvalidArgumentException("author id is not an integer"));
		}

		//Exception if author id is negative
		if($newAuthorId <= 0) {
			throw (new RangeException("author id must be positive"));
		}

		//If author id input passes the above tests (therefore, it is a positive integer), it is considered valid, so it is saved as the author id
		$this->authorId = $newAuthorId;
	}

	/*
	 * Accessor method for title
	 * @return string of title
	 */
	public function getTitle(){
		return $this->title;
	}

	/*
	 * Mutator method for title
	 * @param string $newTitle new value of title
	 * @throws InvalidArgumentException if title is only non-sanitized values
	 * @throws RangeException if title will not fit in the database
	 */
	public function setTitle($newTitle){
		$newTitle = filter_var($newTitle,FILTER_SANITIZE_STRING);

		//Exception if only non-sanitized values
		if($newTitle === false){
			throw(new InvalidArgumentException("title is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newTitle) > 128){
			throw(new RangeException("title is too large"));
		}

		//save the input
		$this->title = $newTitle;
	}

	/*
	 * Accessor method for description
	 * @return string of description
	 */
	public function getDescription(){
		return $this->description;
	}

	/*
	 * Mutator method for description
	 * @param sting $newDescription new value of description
	 * @throws InvalidArgumentException if description is only non-sanitized values
	 * @throws RangeException if description will not fit in the database
	 */
	public function setDescription($newDescription){
		$newDescription = filter_var($newDescription,FILTER_VALIDATE_INT);

		//Exception if only non-sanitized values
		if($newDescription === false){
			throw(new InvalidArgumentException("description is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newDescription) > 500){
			throw(new RangeException("description is too large"));
		}

		//save the input
		$this->description = $newDescription;
	}

	/*
 * Accessor method for copy
 * @return string of copy
 */
	public function getCopy(){
		return $this->copy;
	}

	/*
	 * Mutator method for copy
	 * @param sting $newCopy new value of copy
	 * @throws InvalidArgumentException if copy is only non-sanitized values
	 * @throws RangeException if copy will not fit in the database
	 */
	public function setCopy($newCopy){
		$newCopy = filter_var($newCopy,FILTER_VALIDATE_INT);

		//Exception if only non-sanitized values
		if($newCopy === false){
			throw(new InvalidArgumentException("copy is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newCopy) > 10000){
			throw(new RangeException("copy is too large"));
		}

		//save the input
		$this->copy = $newCopy;
	}

	/*
	 * Accessor method for published time
	 * @return DateTime value of published time
	 */
	public function getPublishedTime() {
		return $this->publishedTime;
	}

	/*
	 * Mutator method for published time
	 * @param mixed $newPublishedTime published time as a DateTime object or string (or null to load current time)
	 * @throws InvalidArgumentException if $newPublishedTime is not a valid object or string
	 * @throws RangeException if $newPublishedTime is a date that does not exist
	 */
	public function setPublishedTime($newPublishedTime){
		//if date is null, use current time and date
		if($newPublishedTime === null){
			$this->publishedTime = new DateTime();
			return;
		}

		//Catch exceptions and display correct error (refers to validate-date.php) and if no exceptions, save the new time.
		try {
			$newPublishedTime = validateDate($newPublishedTime);
		} catch (InvalidArgumentException $invalidArgument) {
			throw (new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch (RangeException $range) {
			throw (new RangeException($range->getMessage(), 0, $range));
		} catch (Exception $exception) {
			throw (new Exception($exception->getMessage(), 0, $exception));
		}
		$this->publishedTime = $newPublishedTime;
	}

	/*
	 * Accessor method for updated time
	 * @return DateTime value of updated time
	 */
	public function getUpdatedTime() {
		return $this->updatedTime;
	}

	/*
	 * Mutator method for updated time
	 * @param mixed $newUpdatedTime last saved time as a DateTime object or string (or null to load current time)
	 * @throws InvalidArgumentException if $newUpdatedTime is not a valid object or string
	 * @throws RangeException if $newUpdatedTime is a date that does not exist
	 */
	public function setUpdatedTime($newUpdatedTime){
		//if date is null, use current time and date
		if($newUpdatedTime === null){
			$this->updatedTime = new DateTime();
			return;
		}

		//Catch exceptions and display correct error (refers to validate-date.php) and if no exceptions, save the new time.
		try {
			$newUpdatedTime = validateDate($newUpdatedTime);
		} catch (InvalidArgumentException $invalidArgument) {
			throw (new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch (RangeException $range) {
			throw (new RangeException($range->getMessage(), 0, $range));
		} catch (Exception $exception) {
			throw (new Exception($exception->getMessage(), 0, $exception));
		}
		$this->updatedTime = $newUpdatedTime;
	}
}