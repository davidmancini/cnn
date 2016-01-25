<?php
namespace Edu\Cnm\Dmancini1\Cnn;
/*
 * Author is the apex entity to write articles.
 *
 * The author is the user who creates articles and associates media with the article.
 * An author must be created in order to create an article.
 *
 * @author David Mancini <mancini.david@gmail.com>
 */
//Secure and Encrypted PDO Database Connection
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
$pdo = connectToEncryptedMySQL("/etc/apache2/data-design/dmancini1.ini");

//LOCAL DEVELOPMENT Connection
//$pdo = new PDO('mysql:host=localhost;dbname=dmancini1', 'dmancini1', 'password');

class Author {

	/*
	 * id is the primary key
	 * @var int $authorId
	 */
	private $authorId;

	/*
	 * email is the author's email address
	 * @var string $email
	 */
	private $email;

	/*
	 * name is the author's first and last name
	 * @var string $name
	 */
	private $name;

	/*
	 * title is the author's title (example: "Senior White House Correspondent")
	 * @var string $title
	 */
	private $title;

	/*
	 * Constructor for Author
	 *
	 * @param mixed $newAuthorId id of the author or null if new author
	 * @param string $newEmail string containing email
	 * @param string $newName string containing name
	 * @param string $newTitle string containing author's title
	 * @throws InvalidArgumentException if data types are not valid
	 * @throws RangeException if data values are out of bounds (strings too long, negative numbers)
	 * @throws Exception if other exception is thrown
	 */
	public function __construct($newAuthorId, $newEmail, $newName, $newTitle) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setEmail($newEmail);
			$this->setName($newName);
			$this->setTitle($newTitle);
		} catch (InvalidArgumentException $invalidArgument) {
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch (RangeException $range) {
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch (Exception $exception) {
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
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
	 * @param int $newAuthorId new value of author id or null if new author id
	 * @throws InvalidArgumentException if author id is not an integer
	 * @throws RangeException if author id is negative
	 */
	public function setAuthorId($newAuthorId) {
		if($newAuthorId === null){
			$this->authorId = null;
			return;
		}

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
	 * Accessor method for email
	 *
	 * @return string value of email
	 */
	public function getEmail() {
		return $this->email;
	}

	/*
	 * Mutator for email
	 *
	 * @param string $newEmail new value of email
	 * @throws InvalidArgumentException if email is not a valid email address
	 * @throws RangeException if email will not fit in the database
	 * @throws Exception if other exception is made
	 */
	public function setEmail($newEmail) {
		$newEmail = filter_var($newEmail, FILTER_VALIDATE_EMAIL);

		//Exception if not a valid email address
		if($newEmail === false) {
			throw (new InvalidArgumentException("email is not a valid email"));
		}

		//Exception if email will not fit in the database
		if(strlen($newEmail) > 128 ) {
			throw(new RangeException("email address is too large"));
		}

//		//Exception if email already in database
//		$pdo = new PDO('mysql:host=localhost;dbname=dmancini1', 'dmancini1', 'password');
//		$checkEmail = $this->$pdo->prepare('SELECT email FROM author WHERE email=:email');
//		$checkEmail->bindValue('email', $email, PDO::PARAM_STR);
//		$checkEmail->execute();
//		$result = $checkEmail->fetchAll();
//		if ($result >0){
//			throw (new DuplicateEmailException("Email address is already in the database"));
//		}


		//If input is a valid email address, save the value
		$this->email = $newEmail;
	}

	/*
	 * Accessor method for name
	 *
	 * @return string for name
	 */
	public function getName() {
		return $this->name;
	}

	/*
	 * Mutator for name
	 *
	 * @param string $newName new value of name
	 * @throws InvalidArgumentException if name is only non-sanitized sting data
	 * @throws RangeException if name will not fit in the database
	 */
	public function setName($newName) {
		$newName = filter_var($newName, FILTER_SANITIZE_STRING);

		//Exception if input is only non-sanitized string data
		if($newName === false) {
			throw (new InvalidArgumentException("name is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newName) > 128) {
			throw (new RangeException("name is too large"));
		}

		//If input is a valid string, save the value
		$this->name = $newName;
	}

	/*
	 * Accessor method for title
	 *
	 * @return string for name
	 */
	public function getTitle() {
		return $this->title;
	}

	/*
	 * Mutator method for title
	 *
	 * @throws InvalidArgumentException if title is only non-standardized string data
	 * @throws RangeException if name will not fit in the database
	 */
	public function setTitle($newTitle) {
		$newTitle = filter_var($newTitle, FILTER_SANITIZE_STRING);

		//Exception if input is only non-sanitized string data
		if($newTitle === false) {
			throw (new InvalidArgumentException("title is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newTitle) > 128) {
			throw(new RangeException("title is too large"));
		}

		//If input is a valid string, save the value
		$this->title = $newTitle;
	}

	/*
	 * Inserts Author into database
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when MySQL related errors occur
	 */
	public function insert (PDO $pdo) {
		//Only insert if new id
		if($this->authorId !== null) {
			throw(new PDOException("not a new author id"));
		}

		//creates query template
		$query = "INSERT INTO author(name, email, title) VALUES (:name, :email, :title)";
		$statement = $pdo->prepare($query);

		//binds variables to placeholders
		$parameters = array("name" => $this->name, "email" => $this->email, "title" => $this->title);
		$statement->execute($parameters);

		//Updates null author id with the newly generated id number from MySQL
		$this->authorId = intval($pdo->lastInsertId());
	}

	/*
	 * Updates Author in database
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when database related error occurs
	 */
	public function update(PDO $pdo){
		//Only updates if not new id
		if($this->authorId === null) {
			throw(new PDOException("Unable to update, author id does not exist."));
		}

		//Create query template
		$query = "UPDATE author SET name = :name, email = :email, title = :title WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		//Bind variables to place holders
		$parameters = array("name" => $this->name, "email" => $this->email, "title" => $this->title, "authorId" => $this->authorId);
		$statement->execute($parameters);
	}

	/*
	 * Deletes Author in database
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when database related error occurs
	 */
	public function delete(PDO $pdo){
		//Only deletes if author id exists
		if($this->authorId == null){
			throw(new PDOException("Unable to delete, author id does not exist."));
		}
		//Create query template
		$query = "DELETE FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		//Bind variables to place holders
		$parameters = array("authorId" => $this->authorId, "name" => $this->name, "email" => $this->email, "title" => $this->title);
		$statement->execute($parameters);
	}
}