<!DOCTYPE html>
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
    <label> Username: </label>
    <input type="text" id="user" name="username" />
  </p>

  <p>
    <label> Artist: </label>
    <input type="text" id="artist" name="artist" />
  </p>

  <p>
    <label> Song: </label>
    <input type="text" id="song" name="song" />
  </p>

  <p>
    <label> Rating (1-5): </label>
    <input type="number" id="rating" name="rating" min="1" max="5"/>
  </p>

  <p>
    <input type="submit" id="button" value="Add Song Rating" />
  </p>
</form>
    </div>
  </body>
</html>
