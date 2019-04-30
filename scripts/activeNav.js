var path = window.location.pathname;
var href = window.location;

var navBtn = document.getElementsByTagName("nav")[0].children;

console.log(href);
console.log(path);

for(var i=0; i<navBtn.length; i++) {
    console.log("Path = " + navBtn[i].pathname);
    console.log("Href = " + navBtn[i].href);
    if(navBtn[i].pathname == path || navBtn[i].href == path) {
        navBtn[i].setAttribute('id', "Active");
        navBtn[i].href = "javascript:void(0)";
    }
}
