
input = document.getElementById("fileUpload");
label	= document.getElementsByClassName("BildeInput")[0];
filename = input.value;


input.addEventListener( 'change', function() {
  console.log(filename);
  if(fileName) {
  	label.innerHTML = fileName;
  }
});
