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
	 * accessor method for author id
	 *
	 * @return int value of author id
	 */
	public function getAuthorId() {
		return $this->authorId;
	}

	/*
	 * Mutator for author id
	 *
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

		//if author id input passes the above tests (therefore, it is a positive integer), it is considered valid, so it is saved as the author id
		$this->authorId = $newAuthorId;
	}
}