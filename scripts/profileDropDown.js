profile = document.getElementById('user');
menu = document.getElementsByClassName('dropdownProfile')[0];

profile.addEventListener("click", toggleDD);

function toggleDD() {
  if (menu.style.display == "none") {
    menu.style.display = "inline-flex"
  } else {
    menu.style.display = "none"
  }
}
