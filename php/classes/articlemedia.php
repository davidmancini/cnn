<?php
namespace Edu\Cnm\Dmancini1\Cnn;
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
	 * Constructor for articlemedia
	 *
	 * @param int $newArticleId foreign key from Article
	 * @param int $newMediaId foreign key from Media
	 * @throws InvalidArgumentException if data types are not valid
	 * @throws RangeException if data values are out of bounds
	 * @throws Exception if other exception is thrown
	 */
	public function __construct($newArticleId, $newMediaId) {
		try {
			$this->setArticleId($newArticleId);
			$this->setMediaId($newMediaId);
		} catch (InvalidArgumentException $invalidArgument) {
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch (RangeException $rangeException) {
			throw(new RangeException($rangeException->getMessage(), 0, $rangeException));
		} catch (Exception $exception) {
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}

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

	//need insert, update, and delete
	//ensure this is all correct....set composite keys
}