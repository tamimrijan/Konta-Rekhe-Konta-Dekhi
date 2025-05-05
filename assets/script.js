const apiKey = 'YOUR_TMDB_API_KEY';
fetch(`https://api.themoviedb.org/3/movie/now_playing?api_key=${apiKey}`)
  .then(res => res.json())
  .then(data => {
    const container = document.getElementById('movie-list');
    data.results.forEach(movie => {
      const div = document.createElement('div');
      div.className = 'movie';
      div.innerHTML = `
        <img src="https://image.tmdb.org/t/p/w200${movie.poster_path}" alt="${movie.title}" />
        <h3>${movie.title}</h3>
        <a href="movie.php?id=${movie.id}">Details</a>
      `;
      container.appendChild(div);
    });
  });