<?php
namespace Edu\Cnm\Dmancini1\Cnn;

require_once(dirname(__DIR__) . "/lib/validate-date.php");

/*
 * Article
 *
 * Article is the actual content of a news article, including title, description, and content (copy)
 * Article does not contain any media or media ids; the link to media is located in articleMedia.
 *
 * @author David Mancini <mancini.david@gmail.com>
 */
//Secure and Encrypted PDO Database Connection
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
$pdo = connectToEncryptedMySQL("/etc/apache2/data-design/dmancini1.ini");

//LOCAL DEVELOPMENT Connection
//$pdo = new PDO('mysql:host=localhost;dbname=dmancini1', 'dmancini1', 'password');

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
	 * Constructor for Article
	 *
	 * @param mixed $newArticleId of the article or null if new article
	 * @param int $newAuthorId foreign key from Author
	 * @param string $newTitle string containing article title
	 * @param string $newDescription string containing article description
	 * @param string $newCopy string containing content (copy) of the article
	 * @param mixed $newPublishedTime date and time the article was first saved or null if set to current time and date
	 * @param mixed $newUpdatedTime date and time the article was last saved or null if set to current time and date
	 * @throws InvalidArgumentException if data types are not valid
	 * @throws RangeException if data values are out of bounds (strings too long, negative numbers)
	 * @throws InvalidArgumentException if the date is in an invalid format
	 * @throws RangeException if the date is not a Gregorian date
	 * @throws Exception if other exception is thrown
	 */
//	public function __construct($newArticleId, $newAuthorId, $newTitle, $newDescription, $newCopy, $newPublishedTime, $newUpdatedTime) {
//		try {
//			$this->setArticleId($newArticleId);
//			$this->setAuthorId($newAuthorId);
//			$this->setTitle($newTitle);
//			$this->setDescription($newDescription);
//			$this->setCopy($newCopy);
//			$this->setPublishedTime($newPublishedTime);
//			$this->setUpdatedTime($newPublishedTime);
//		} catch(InvalidArgumentException $invalidArgument) {
//			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
//		} catch(RangeException $range) {
//			throw(new RangeException($range->getMessage(), 0, $range));
//		} catch(Exception $exception) {
//			throw(new Exception($exception->getMessage(), 0, $exception));
//		}
//	}
	public function __construct($newArticleId, $newAuthorId, $newTitle, $newDescription, $newCopy) {
		try {
			$this->setArticleId($newArticleId);
			$this->setAuthorId($newAuthorId);
			$this->setTitle($newTitle);
			$this->setDescription($newDescription);
			$this->setCopy($newCopy);
		} catch(InvalidArgumentException $invalidArgument) {
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception) {
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}
	/*
	 * Accessor method for article id
	 * @return int value of article id
	 */
	public function getArticleId() {
		return ($this->articleId);
	}

	/*
	 * Mutator method for article id
	 * @param int $newArticleId of new article id
	 * @throws InvalidArgumentException if article id is not an integer
	 * @throws RangeException if article id is negative
	 */
	public function setArticleId($newArticleId) {
		if($newArticleId === null) {
			$this->articleId = null;
			return;
		}

		//filter
		$newArticleId = filter_var($newArticleId, FILTER_VALIDATE_INT);

		//Exception if not int
		if($newArticleId === false) {
			throw(new InvalidArgumentException("article id is not an integer"));
		}

		//Exception if not in range
		if($newArticleId <= 0) {
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
	public function getTitle() {
		return $this->title;
	}

	/*
	 * Mutator method for title
	 * @param string $newTitle new value of title
	 * @throws InvalidArgumentException if title is only non-sanitized values
	 * @throws RangeException if title will not fit in the database
	 */
	public function setTitle($newTitle) {
		$newTitle = filter_var($newTitle, FILTER_SANITIZE_STRING);

		//Exception if only non-sanitized values
		if($newTitle === false) {
			throw(new InvalidArgumentException("title is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newTitle) > 128) {
			throw(new RangeException("title is too large"));
		}

		//save the input
		$this->title = $newTitle;
	}

	/*
	 * Accessor method for description
	 * @return string of description
	 */
	public function getDescription() {
		return $this->description;
	}

	/*
	 * Mutator method for description
	 * @param sting $newDescription new value of description
	 * @throws InvalidArgumentException if description is only non-sanitized values
	 * @throws RangeException if description will not fit in the database
	 */
	public function setDescription($newDescription) {
		$newDescription = filter_var($newDescription, FILTER_SANITIZE_STRING);

		//Exception if only non-sanitized values
		if($newDescription === false) {
			throw(new InvalidArgumentException("description is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newDescription) > 500) {
			throw(new RangeException("description is too large"));
		}

		//save the input
		$this->description = $newDescription;
	}

	/*
 * Accessor method for copy
 * @return string of copy
 */
	public function getCopy() {
		return $this->copy;
	}

	/*
	 * Mutator method for copy
	 * @param sting $newCopy new value of copy
	 * @throws InvalidArgumentException if copy is only non-sanitized values
	 * @throws RangeException if copy will not fit in the database
	 */
	public function setCopy($newCopy) {
		$newCopy = filter_var($newCopy, FILTER_SANITIZE_STRING);

		//Exception if only non-sanitized values
		if($newCopy === false) {
			throw(new InvalidArgumentException("copy is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newCopy) > 10000) {
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
	public function setPublishedTime($newPublishedTime) {
		//if date is null, use current time and date
		if($newPublishedTime === null) {
			$this->publishedTime = new DateTime();
			return;
		}

		//Catch exceptions and display correct error (refers to validate-date.php) and if no exceptions, save the new time.
		try {
			$newPublishedTime = validateDate($newPublishedTime);
		} catch(InvalidArgumentException $invalidArgument) {
			throw (new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			throw (new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception) {
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
	public function setUpdatedTime($newUpdatedTime) {
		//if date is null, use current time and date
		if($newUpdatedTime === null) {
			$this->updatedTime = new DateTime();
			return;
		}

		//Catch exceptions and display correct error (refers to validate-date.php) and if no exceptions, save the new time.
		try {
			$newUpdatedTime = validateDate($newUpdatedTime);
		} catch(InvalidArgumentException $invalidArgument) {
			throw (new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			throw (new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception) {
			throw (new Exception($exception->getMessage(), 0, $exception));
		}
		$this->updatedTime = $newUpdatedTime;
	}

	/*
	 * Inserts article into database
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when MySQL related error occurs
	 */
	public function insert(PDO $pdo) {
		//Only inserts if new id
		if($this->articleId !== null) {
			throws(new PDOException("not a new article id"));
		}

		//creates query
		$query = "INSERT INTO article(authorId, title, description, copy) VALUES(:authorId, :title, :description, :copy)";
		$statement = $pdo->prepare($query);

		//binds variables to placeholders
		$parameters = array("authorId" => $this->authorId, "title" => $this->title, "description" => $this->description, "copy" => $this->copy);
		$statement->execute($parameters);

		//updates null article id with the newly generated id number from database
		$this->articleId = intval($pdo->lastInsertId());
	}

	/*
	 * Updates article in database
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when database related error occurs
	 */
	public function update (PDO $pdo){
		//Only updates if not new id
		if($this->authorId === null) {
			throw(new PDOException("Unable to update, article id does not exist."));
		}

		//create query template
		$query = "UPDATE article SET authorId = :authorId, title = :title, description = :description, copy = :copy";
		$statement = $pdo->prepare($query);

		//bind variables to place holders
		$parameters = array("authorId" => $this->authorId, "title" => $this->title, "description" => $this->description, "copy" => $this->copy);
		$statement->execute($parameters);
	}

	/*
	 * Delete article in database
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when database related errors occur
	 */
	public function delete(PDO $pdo){
		//only deletes if author id exists
		if($this->authorId == null){
			throw(new PDOException("Unable to delete, article id does not exist."));
		}

		//create query
		$query = "DELETE FROM article WHERE articleId = :articleId";
		$statement = $pdo->prepare($query);

		//bind variables to place holders
		$parameters = array("articleId" => $this->authorId);
		$statement->execute($parameters);
	}
}