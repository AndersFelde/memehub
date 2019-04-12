var path = window.location.pathname;
var href = window.location;

var navBtn = document.getElementsByTagName("nav")[0].children;


for(var i=0; i<navBtn.length; i++) {
    if(navBtn[i].pathname == path) {
        navBtn[i].setAttribute('id', "Active");
        navBtn[i].href = "javascript:void(0)";
    }
}
