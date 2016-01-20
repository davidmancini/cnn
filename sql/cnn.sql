-- DROP children first
DROP TABLE IF EXISTS authorMedia;
DROP TABLE IF EXISTS media;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS author;

CREATE TABLE author (
  authorId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  name VARCHAR(128) NOT NULL,
  email VARCHAR(128) NOT NULL,
  title VARCHAR(128) NOT NULL,
-- This creates a unique index.
  UNIQUE(email),
  PRIMARY KEY(authorId)
);

CREATE TABLE article (
  articleId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  authorId INT UNSIGNED NOT NULL,
  title VARCHAR(128) NOT NULL,
  description VARCHAR(500) NOT NULL,
  copy VARCHAR(10000) NOT NULL,
  publishedTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updatedTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX(authorId),
  FOREIGN KEY(authorId) REFERENCES author(authorId),
  PRIMARY KEY(articleId)
);

CREATE TABLE media (
  mediaId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  url VARCHAR(128) NOT NULL,
  title VARCHAR(128) NOT NULL,
  caption VARCHAR(128) NOT NULL,
  INDEX(mediaId),
  PRIMARY KEY(mediaId)
);

CREATE TABLE articleMedia (
  mediaId INT UNSIGNED NOT NULL,
  articleId INT UNSIGNED NOT NULL,
  INDEX(mediaId),
  INDEX(articleId),
  FOREIGN KEY(mediaId) REFERENCES media(mediaId),
  FOREIGN KEY(articleId) REFERENCES article(articleId),
  PRIMARY KEY(mediaId, articleId)
);
