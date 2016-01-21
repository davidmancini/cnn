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




}