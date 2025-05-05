<?php
session_start();
require_once 'includes/db.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: login.html');
  exit();
}
$userId = $_SESSION['user_id'];

function fetchMovies($pdo, $userId, $status) {
  $stmt = $pdo->prepare("SELECT * FROM user_movies WHERE user_id = ? AND status = ?");
  $stmt->execute([$userId, $status]);
  return $stmt->fetchAll();
}

$watchlist = fetchMovies($pdo, $userId, 'watchlist');
$watched = fetchMovies($pdo, $userId, 'watched');
$planning = fetchMovies($pdo, $userId, 'planning');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Movie Tracker</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <header>
    <h1>Your Dashboard</h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <main>
    <section>
      <h2>Watchlist</h2>
      <div id="movie-list">
        <?php foreach ($watchlist as $movie): ?>
          <div class="movie">
            <h3><?= htmlspecialchars($movie['title']) ?></h3>
            <form method="POST" action="actions/update_list.php">
              <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
              <select name="status">
                <option value="watchlist" selected>Watchlist</option>
                <option value="watched">Watched</option>
                <option value="planning">Planning</option>
              </select>
              <button type="submit">Update</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section>
      <h2>Watched</h2>
      <div id="movie-list">
        <?php foreach ($watched as $movie): ?>
          <div class="movie">
            <h3><?= htmlspecialchars($movie['title']) ?></h3>
            <form method="POST" action="actions/update_list.php">
              <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
              <select name="status">
                <option value="watchlist">Watchlist</option>
                <option value="watched" selected>Watched</option>
                <option value="planning">Planning</option>
              </select>
              <button type="submit">Update</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section>
      <h2>Planning</h2>
      <div id="movie-list">
        <?php foreach ($planning as $movie): ?>
          <div class="movie">
            <h3><?= htmlspecialchars($movie['title']) ?></h3>
            <form method="POST" action="actions/update_list.php">
              <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
              <select name="status">
                <option value="watchlist">Watchlist</option>
                <option value="watched">Watched</option>
                <option value="planning" selected>Planning</option>
              </select>
              <button type="submit">Update</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>
</body>
</html>
