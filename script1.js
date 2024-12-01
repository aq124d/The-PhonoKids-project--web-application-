function updateGameProgress(gameId, progress, points) {
  const gameElement = document.getElementById(gameId);
  const progressBar = gameElement.querySelector('.progress-value');
  const stars = gameElement.querySelectorAll('.star');

  progressBar.style.width = progress + '%';
  
  const numStars = stars.length;
  const starPositions = [25, 50, 75];
  
  // Iterate through stars and adjust visibility based on progress
  stars.forEach((star, index) => {
    if (progress >= starPositions[index]) {
      star.classList.add('gold-star');
    } else {
      star.classList.remove('gold-star');
    }
  });
}

// Update progress for Math Adventure game
updateGameProgress('game1', 70, 350);

// Update progress for English Adventure game
updateGameProgress('game2', 50, 250);

// Update progress for Science Adventure game
updateGameProgress('game3', 20, 100);
