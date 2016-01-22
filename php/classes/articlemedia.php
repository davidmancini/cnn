<?php
/*
 * articlemedia
 *
 * matching media id with article id
 *
 * @author David Mancini <mancini.david@gmail.com>
 */
class ArticleMedia {

	/*
	 * article id is part 1/2 of the composite key and is a foreign key from Article
	 * @var int articleId
	 */
	private $articleId;

	/*
	 * media id is part 2/2 of the composite key and is a foreign key from Media
	 * @var int mediaId
	 */
	private $mediaId;

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
 * Accessor method for media id
 * @return int value of media id
 */
	public function getMediaId() {
		return $this->mediaId;
	}

	/*
	 * Mutator method for media id
	 * @throws InvalidArgumentException if media id is not an integer
	 * @throws RangeException if media id is negative
	 */
	public function setMediaId($newMediaId) {

		//filter
		$newMediaId = filter_var($newMediaId, FILTER_VALIDATE_INT);

		//Exception if not int
		if($newMediaId === false) {
			throw(new InvalidArgumentException("media id is not an integer"));
		}

		//Exception if not in range
		if($newMediaId <= 0){
			throw(new RangeException("media id must be positive"));
		}

		//save the object
		$this->mediaId = $newMediaId;
	}

}