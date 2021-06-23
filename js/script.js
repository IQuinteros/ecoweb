
let appBarOpen = false;

function toggleMenu(){
    let appbar = document.getElementById('appbar');
    appBarOpen
        ? appbar.classList.remove('open')
        : appbar.classList.add('open')
    appBarOpen = !appBarOpen;
}