/* APP BAR */
let appBarOpen = false;

function toggleMenu(){
    let appbar = document.getElementById('appbar');
    appBarOpen
        ? appbar.classList.remove('open')
        : appbar.classList.add('open')
    appBarOpen = !appBarOpen;
}

/* CHART */

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];
  const data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [0, 10, 5, 2, 20, 30, 45],
    }]
};

const config = {
    type: 'line',
    data,
    options: {
        responsive: true,
        maintainAspectRatio: true
    }
};

let myChart = new Chart(
    document.getElementById('myChart'),
    config
);

myChart.width = parent.offsetWidth;
myChart.height = parent.offsetWidth;

window.addEventListener('resize', () => {
    myChart.width = 10
    myChart.height = 10
});