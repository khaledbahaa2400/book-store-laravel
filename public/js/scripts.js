let menuButton = document.querySelector('#menu-btn');
let userButton = document.querySelector('#user-btn');
let navbar = document.querySelector('#navbar');
let accountBox = document.querySelector('#account-box');

menuButton.onclick = () => {
    navbar.classList.toggle('active');
    accountBox.classList.remove('active');
}

userButton.onclick = () => {
    accountBox.classList.toggle('active');
    navbar.classList.remove('active');
}

document.addEventListener('click', function (event) {
    if (userButton.contains(event.target) || menuButton.contains(event.target) || navbar.contains(event.target) || accountBox.contains(event.target))
        return;
    navbar.classList.remove('active');
    accountBox.classList.remove('active');
})

window.onscroll = () => {
    accountBox.classList.remove('active');
    navbar.classList.remove('active');
}