<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CNN Article Project</title>
		<link rel="stylesheet" href="css/style.css">
		<link href='https://fonts.googleapis.com/css?family=News+Cycle|Raleway' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<h1>Data Design Project: CNN Article</h1>

		<!-- PERSONA -->
		<div class="boxtitle">Persona</div>
		<div class="box">
			<span class="boxheading">Demographics</span><br>
				Name: Jacob Alexander Mayer<br>
				Age: 37 years old<br>
				Career: Manager of an advertising agency<br>
				Education: BA in marketing<br>
				Ethnicity: Caucasian<br>
				Family Status: Married<br><br>
			<span class="boxheading">Website Goals</span><br>
				Jacob wants to quickly find and read relevant news and view associated media.<br>
		</div><br>

		<!-- USE CASES -->
		<div class="boxtitle">Use Cases</div>
		<div class="box">
			<span class="boxheading">Main Goal</span><br>
				The author logs in and creates a new article, with media, for visitors to read.  The system automatically logs when the article is published, and displays if/when it was updated.<br><br>A visitor comes to the news article page to read a news story and view associated media.  The visitor should also be able to identify the author and the date and time that the article was published and/or updated.<br><br>
			<span class="boxheading">Steps</span>
				<ol>
					<li>The author must log into the system, so his <span class="monospace">authorId</span> can be associated with the article.</li>
					<li>The author adds copy and associates some media.  The <span class="monospace">articleId</span> will be associated with the <span class="monospace">mediaId</span> and <span class="monospace">authorId</span> in the database.</li>
					<li>Now that the article is published, a viewer can visit the site to read the article and view the media.</li>
				</ol>
		</div>

		<!-- ERG -->
		<div class="boxtitle">Entity Relationship Diagram</div>
		<div class="box">
			<p>An author writes an article and includes some media (photos, videos, etc.) so that a reader can view everything in one place.</p>
			<img src="images/cnn-erg.svg" alt="Entity Relationship Diagram for CNN Project">
		</div>
	</body>
</html>