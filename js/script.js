/* Prototypes */
HTMLCollection.prototype.forEach = function (callback){
    for (let i = 0; i < this.length; i++) {
        callback(this[i], i);
    }
}

/* APP BAR */
let appBarOpen = false;

function toggleMenu(){
    let appbar = document.getElementById('appbar');
    appBarOpen
        ? appbar.classList.remove('open')
        : appbar.classList.add('open')
    appBarOpen = !appBarOpen;
}

/* Chart */

const charts = document.getElementsByClassName("chart");
charts.forEach((item) => {
    item.width = parent.offsetWidth;
    item.height = parent.offsetWidth;
});

window.addEventListener('resize', () => {
    charts.forEach((item) => {
        item.width = 10;
        item.height = 10;
    });
});