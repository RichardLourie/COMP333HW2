<!-- page to add a song -->
<!DOCTYPE html>
<html>
  <head>
    <title>Add a song</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <div id="form-container">
      <h1 class="page-title">Add a Song</h1>
      <!-- form inputs passed to  add_song.php to add-->
      <form name="form" action="add_song.php" method="POST">
        <div class="form-group">
          <label for="artist">Artist:</label>
          <input type="text" id="artist" name="artist" required />
        </div>
        <div class="form-group">
          <label for="song">Song:</label>
          <input type="text" id="song" name="song" required />
        </div>
        <div class="form-group">
          <label for="rating">Rating (1-5):</label>
          <input type="number" id="rating" name="rating" min="1" max="5" required />
        </div>
        <div class="form-group">
          <input type="submit" id="add-button" value="Add Song Rating" />
        </div>
      </form>
      <a class="back-link" href="ratingsPage.php">Back to ratings page</a>
    </div>
  </body>
</html>


<!-- old form -->
<!-- <!DOCTYPE html>
<html>
  <head>
    <title>Add a song</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>

  <body>
    <div id="form">
      <h1>Add a song!</h1>
      <form name="form" action="add_song.php" method="POST">

  <p>
    <label> Artist: </label>
    <input type="text" id="artist" name="artist" required/>
  </p>

  <p>
    <label> Song: </label>
    <input type="text" id="song" name="song" required/>
  </p>

  <p>
    <label> Rating (1-5): </label>
    <input type="number" id="rating" name="rating" min="1" max="5" required/>
  </p>

  <p>
    <input type="submit" id="button" value="Add Song Rating" />
  </p>
</form>
    </div>
  </body>
</html> -->
