bod = document.getElementsByTagName('body')[0];
//console.log(bod);
bod.addEventListener('load', errMsg());

function errMsg() {
  errorPresent = document.getElementById('error');
  //console.log(errorPresent);
  if (errorPresent !== false) {
    which = errorPresent.innerHTML;
    //console.log(which);
    errBox = document.getElementsByClassName(which)[0];
    //console.log(errBox);
    errBox.style.userSelect = 'auto';
    errBox.style.backgroundColor = '#FF4E4E';
    errBox.style.boxShadow = '0px 5px 16px 0px rgba(0,0,0,0.2)';
  }

}
