const body = document.querySelector('body'),
sidebar = body.querySelector('nav'),
toggle = body.querySelector(".toggle"),
searchBtn = body.querySelector(".search-box"),
modeSwitch = body.querySelector(".toggle-switch"),
modeText = body.querySelector(".mode-text");

toggle.addEventListener("click" , () => {
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () => {
    sidebar.classList.remove("close");
})

// JavaScript code to switch from light mode to dark mode
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');
if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);
    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
    }
}

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        modeText.innerText = "Dark mode";
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
        modeText.innerText = "Light mode";
    }
}
toggleSwitch.addEventListener('change', switchTheme, false);
