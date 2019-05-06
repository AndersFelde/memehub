profile = document.getElementById('user');
menu = document.getElementsByClassName('dropdownProfile')[0];

profile.addEventListener("click", toggleDD);

function toggleDD() {
  if (menu.style.display == "inline-flex") {
    menu.style.display = "none"
  } else {
    menu.style.display = "inline-flex"
  }
}
