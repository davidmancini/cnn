<?php
/*
 * Author is the apex entity to write articles.
 *
 * The author is the user who creates articles and associates media with the article.
 * An author must be created in order to create an article.
 *
 * @author David Mancini <mancini.david@gmail.com>
 */
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
			throw (new TypeError("author id is not an integer"));
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

		//If input is a vals string, save the value
		$this->title = $newTitle;
	}
}