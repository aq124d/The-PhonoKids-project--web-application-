document.addEventListener("DOMContentLoaded", function() {
  const game1Chart = document.getElementById('game1-chart').getContext('2d');
  const game2Chart = document.getElementById('game2-chart').getContext('2d');
  const game3Chart = document.getElementById('game3-chart').getContext('2d');

  // Example completion percentages for each game
  const game1Completion = 50; // 50% completion
  const game2Completion = 75; // 75% completion
  const game3Completion = 100; // 100% completion

  createChart(game1Chart, 'Game 1 Progress', game1Completion);
  createChart(game2Chart, 'Game 2 Progress', game2Completion);
  createChart(game3Chart, 'Game 3 Progress', game3Completion);
});

function createChart(ctx, title, completionPercentage) {
  const progressData = {
    labels: ['Progress'],
    datasets: [{
      label: 'Completion',
      backgroundColor: '#1E0342',
      data: [completionPercentage]
    }]
  };

  const options = {
    responsive: false,
    maintainAspectRatio: false,
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          max: 100
          
        }
      }]
    }
  };
  
  new Chart(ctx, {
    type: 'bar',
    data: progressData,
    options: {
      title: {
        display: true,
        text: title
      },
      legend: {
        display: false
      },
      barPercentage: 0.5 
    }
  });
}  