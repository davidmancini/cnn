<?php
/*
 * Media
 *
 * Media holds information, including name, caption, and url of media to be associated with an article
 *
 * @author David Mancini <mancini.david@gmail.com>
 */

class Media {

	/*
	 * id is the primary key
	 * @var int mediaId
	 */
	private $mediaId;

	/*
 * caption is the caption of the media
 * @var string caption
 */
	private $caption;

	/*
	 * title is the title of the media
	 * @var string title
	 */
	private $title;

	/*
	 * url is the location of the media
	 * @var string url
	 */
	private $url;

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

	/*
	 * Accessor method for caption
	 * @return string of caption
	 */
	public function getCaption(){
		return $this->caption;
	}

	/*
	 * Mutator method for caption
	 * @param string $newCaption new value of caption
	 * @throws InvalidArgumentException if title is only non-sanitized values
	 * @throws RangeException if title will not fit in the database
	 */
	public function setCaption($newCaption){
		$newCaption = filter_var($newCaption,FILTER_SANITIZE_STRING);

		//Exception if only non-sanitized values
		if($newCaption === false){
			throw(new InvalidArgumentException("caption is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newCaption) > 128){
			throw(new RangeException("caption is too large"));
		}

		//save the input
		$this->caption = $newCaption;
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
	 * Accessor method for url
	 * @return string of url
	 */
	public function getUrl(){
		return $this->url;
	}

	/*
	 * Mutator method for url
	 * @param string $newUrl new value of url
	 * @throws InvalidArgumentException if url is only non-sanitized values
	 * @throws RangeException if url will not fit in the database
	 */
	public function setUrl($newUrl){
		$newUrl = filter_var($newUrl,FILTER_SANITIZE_URL);

		//Exception if only non-sanitized values
		if($newUrl === false){
			throw(new InvalidArgumentException("url is not a valid string"));
		}

		//Exception if input will not fit in the database
		if(strlen($newUrl) > 128){
			throw(new RangeException("url is too large"));
		}

		//save the input
		$this->url = $newUrl;
	}
}