ting = document.getElementById('synd');
forgot = document.getElementsByClassName('forgotPassword')[0];
//console.log(forgot);
forgot.addEventListener("click", synd);

function synd() {
  ting.style.display = 'inline-block';
  setTimeout(syndHide, 1000);
}

function syndHide() {
  ting.style.display = 'none';
}
