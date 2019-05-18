<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    $Title = "Utforsk";
    include "elements/head.php";
    ?>
    <script>
        function searchOpt() {

            var searchOtherDiv = document.createElement( "DIV" );
            if ( type == "bruker" ) {
                var arr = brukerArr;
                var value = brukerArr[ i ];
                var img = brukerArr[ i + 1 ];
                searchOtherDiv.id = "divImg" + i;
                searchOtherDiv.className = "search-img";
                searchOtherDiv.style.backgroundImage = "url('" + img + "')";
            } else {
                var arr = kategoriArr;
                var value = kategoriArr[ i ];
                var count = kategoriArr[ i + 1 ];
                searchOtherDiv.id = "divCount" + i;
                searchOtherDiv.className = "search-count";
                searchOtherDiv.innerHTML = count;
            }

            var start = value.toLowerCase().indexOf( val.toLowerCase() );
            var end = val.length;



            var searchTextDiv = document.createElement( "DIV" );
            searchTextDiv.className = "search-text";

            if ( start == 0 ) {
                searchTextDiv.innerHTML = "<strong>" + value.substr( 0, end ) +
                    "</strong>";
                searchTextDiv.innerHTML += value.substr( end );
            } else {

                searchTextDiv.innerHTML = value.substr( 0, start );
                searchTextDiv.innerHTML += "<strong>" + value.substr( start, end ) + "</strong>";
                searchTextDiv.innerHTML += value.substr( ( start + end ) );



            }


            /*create a DIV element for each matching element:*/
            b = document.createElement( "DIV" );
            b.setAttribute( "class", "autocomplete-wrap" );
            b.setAttribute( "id", i );
            a.appendChild( b );

            /*make the matching letters bold:*/

            /*insert a input field that will hold the current array item's value:*/

            searchTextDiv.innerHTML += "<input type='hidden' value='" + value + "'>";
            b.appendChild( searchTextDiv )

            b.appendChild( searchOtherDiv )
                /*execute a function when someone clicks on the item value (DIV element):*/


        };

        function currentFocusRemove() {
            if ( currentFocus > -1 ) {
                x[ currentFocus ].classList.remove( "autocomplete-active" );
                currentFocus = -1;
            }
        }

        function autocomplete( inp, kategoriArr, brukerArr ) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*
            var currentFocus;
            /*execute a function when someone writes in the text field:*/


            inp.addEventListener( "input", function ( e ) {
                val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if ( !val ) {
                    return false;
                }

                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement( "DIV" );
                a.setAttribute( "id", this.id + "autocomplete-list" );
                a.setAttribute( "class", "autocomplete-items" );
                a.setAttribute( "onmouseover", "currentFocusRemove()" )
                    /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild( a );
                /*for each item in the array...*/

                var find = 0;

                for ( i = 0; i < kategoriArr.length - 1; i += 2 ) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if ( kategoriArr[ i ].toUpperCase().includes( val.toUpperCase() ) ) {
                        type = "kat";
                        searchOpt();
                        find++;
                    }


                }
                for ( i = 0; i < brukerArr.length - 1; i += 2 ) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if ( brukerArr[ i ].toUpperCase().includes( val.toUpperCase() ) ) {
                        type = "bruker"
                        searchOpt();
                        find++;
                    }


                }

                if ( find == 0 ) {
                    b = document.createElement( "DIV" );
                    b.setAttribute( "class", "autocomplete-wrap" );
                    a.appendChild( b );

                    var searchTextDiv = document.createElement( "DIV" );
                    searchTextDiv.className = "search-text";
                    searchTextDiv.innerHTML = "<strong>Ingen funn for søket</strong>";
                    searchTextDiv.innerHTML += "<input type='hidden' value='" + val + "'>";
                    b.appendChild( searchTextDiv )
                }
            } );



            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener( "keydown", function ( e ) {

                x = document.getElementById( this.id + "autocomplete-list" );

                if ( x ) x = x.getElementsByClassName( "autocomplete-wrap" );

                if ( e.keyCode == 40 ) {
                    e.preventDefault();
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive( x );
                } else if ( e.keyCode == 38 ) { //up
                    e.preventDefault();
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive( x );
                }


            } );

            function closeAllLists() {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName( "autocomplete-items" );
                for ( var i = 0; i < x.length; i++ ) {
                    x[ i ].parentNode.removeChild( x[ i ] );
                    x = "";

                }
            }

            document.getElementById( "searchForm" ).addEventListener( "submit", function ( event ) {
                event.preventDefault();
                if ( currentFocus === "undefined" ) {
                    closeAllLists();
                    searchResult( inp.value )
                } else {
                    if ( currentFocus > -1 ) {
                        inp.value = x[ currentFocus ].getElementsByTagName( "input" )[ 0 ].value;
                        inp.focus();
                        currentFocusRemove();

                    } else {
                        closeAllLists();
                        searchResult( inp.value )
                    }

                }
            } );





            function addActive( x ) {
                /*a function to classify an item as "active":*/
                if ( !x ) return false;
                /*start by removing the "active" class on all items:*/
                removeActive( x );
                if ( currentFocus >= x.length ) currentFocus = 0;
                if ( currentFocus < 0 ) currentFocus = ( x.length - 1 );
                /*add class "autocomplete-active":*/
                x[ currentFocus ].classList.add( "autocomplete-active" );
            }

            function removeActive( x ) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for ( var i = 0; i < x.length; i++ ) {
                    x[ i ].classList.remove( "autocomplete-active" );
                }
            }


            /*execute a function when someone clicks in the document:*/
            document.addEventListener( "click", function ( e ) {
                if ( document.contains( document.getElementById( "myInputautocomplete-list" ) ) ) {
                    if ( document.getElementById( "myInputautocomplete-list" ).contains( e.target ) ) {
                        inp.value = e.target.getElementsByTagName( "input" )[ 0 ].value
                        closeAllLists()
                        searchResult( inp.value )

                    } else if ( e.target.isEqualNode( inp ) ) {
                        inp.focus();
                    } else {
                        closeAllLists()
                    }


                }
            } );
        };

        function searchArr() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if ( this.readyState == 4 && this.status == 200 ) {
                    var searchArr = this.responseText.split( "^" );

                    kategoriArr = searchArr[ "0" ].split( "," );
                    brukerArr = searchArr[ "1" ].split( "," );
                    autocomplete( document.getElementById( "myInput" ), kategoriArr, brukerArr );

                }

            }
            xmlhttp.open( "GET", "elements/search_arr.php", true );
            xmlhttp.send();
        }

        function searchResult( search ) {
            
            var  searchingDiv= document.createElement( "div" );
            searchingDiv.innerHTML = "<strong>searching</strong>";
            document.body.insertBefore( searchingDiv, document.getElementById( "searchForm" ).nextSibling );
            
            if(document.body.contains(document.getElementById("results"))){
                document.body.removeChild( document.getElementById("results") );
            }
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if ( this.readyState == 4 && this.status == 200 ) {
                    searchingDiv.parentNode.removeChild( searchingDiv );
                    var resultDiv = document.createElement( "div" );
                    resultDiv.setAttribute( "class", "results" );
                    resultDiv.setAttribute( "id", "results" );
                    resultDiv.innerHTML = this.responseText;
                    document.body.insertBefore( resultDiv, document.getElementById( "searchForm" ).nextSibling );

                }

            }
            xmlhttp.open( "GET", "elements/search_result.php?search=" + search + "&brukerId=" + sessionStorage.getItem("brukerId"), true );
            xmlhttp.send();
        }
        
        function resultKategori(search){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if ( this.readyState == 4 && this.status == 200 ) {
                    var resultKategoriDiv = document.createElement( "div" );
                    var button = document.getElementById("resultKategori");
                    resultKategoriDiv.setAttribute( "id", "resultsKategori" );
                    resultKategoriDiv.innerHTML = this.responseText;
                    document.getElementById("results").insertBefore( resultKategoriDiv, button.nextSibling);
                    button.innerHTML = "Hide Kategori";
                    button.setAttribute("onclick", "delResultKategori('" + search + "')");
                    

                }

            }
            xmlhttp.open( "GET", "elements/search_kategori.php?search=" + search + "&brukerId=" + sessionStorage.getItem("brukerId"), true );
            xmlhttp.send();
        }
        
        function delResultKategori(search){
            document.getElementById("results").removeChild( document.getElementById("resultsKategori") );
            var button = document.getElementById("resultKategori");
            button.innerHTML = "Show Kategori";
            button.setAttribute("onclick", "resultKategori('" + search + "')");
        }
    </script>
</head>

<body onload="searchArr()">
    <?php
    include "elements/nav.php";
if(isset($_SESSION["bruker_id"])){
    
    include "elements/utforsk_search.php";
} else {
    echo "<p><a href='logg_inn.php'>Logg inn</a> først du</p>";
}


    ?>

    <div class="footer"></div>
</body>
</html>