<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    $Title = "Utforsk";
    include "elements/head.php";
    ?>
    <script>
        function autocomplete( inp, arr ) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener( "input", function ( e ) {
                var a, b, i, val = this.value;
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
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild( a );
                /*for each item in the array...*/
                for ( i = 0; i < arr.length; i++ ) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if ( arr[ i ].substr( 0, val.length ).toUpperCase() == val.toUpperCase() ) {
                        if ( arr[ i ].includes( "*" ) ) {
                            var value = arr[ i ].split( "*" )[ 0 ];
                            var img = arr[ i ].split( "*" )[ 1 ];
                        } else {
                            var value = arr[ i ];
                            var img = "";
                        }
                        /*create a DIV element for each matching element:*/
                        b = document.createElement( "DIV" );
                        b.addEventListener( "click", function ( e ) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName( "input" )[ 0 ].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        } );
                        a.appendChild( b );
                        var searchTextDiv = document.createElement( "DIV" );
                        /*make the matching letters bold:*/
                        searchTextDiv.className = "search-text";
                        searchTextDiv.innerHTML += "<strong>" + arr[ i ].substr( 0, val.length ) + "</strong>";
                        searchTextDiv.innerHTML += value.substr( val.length );
                        /*insert a input field that will hold the current array item's value:*/

                        searchTextDiv.innerHTML += "<input type='hidden' value='" + value + "'>";
                        b.appendChild( searchTextDiv )

                        var searchImgDiv = document.createElement( "DIV" );
                        searchImgDiv.id = "divImg" + i;
                        searchImgDiv.className = "search-img";
                        searchImgDiv.style.backgroundImage = "url('" + img + "')";
                        b.appendChild( searchImgDiv )
                        /*execute a function when someone clicks on the item value (DIV element):*/
                    }
                }
            } );
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener( "keydown", function ( e ) {
                var x = document.getElementById( this.id + "autocomplete-list" );
                if ( x ) x = x.getElementsByTagName( "div" );
                if ( e.keyCode == 40 ) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive( x );
                } else if ( e.keyCode == 38 ) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive( x );
                } else if ( e.keyCode == 13 ) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if ( currentFocus > -1 ) {
                        /*and simulate a click on the "active" item:*/
                        if ( x ) x[ currentFocus ].click();
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

            function closeAllLists( elmnt ) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName( "autocomplete-items" );
                for ( var i = 0; i < x.length; i++ ) {
                    if ( elmnt != x[ i ] && elmnt != inp ) {
                        x[ i ].parentNode.removeChild( x[ i ] );
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener( "click", function ( e ) {
                closeAllLists( e.target );
            } );
        };

        function searchArr() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if ( this.readyState == 4 && this.status == 200 ) {
                    var searchArr = this.responseText.split( "," );
                    console.log( searchArr );
                    var input = document.getElementById( "myInput" )

                    autocomplete( document.getElementById( "myInput" ), searchArr );

                }

            }
            xmlhttp.open( "GET", "elements/search_arr.php", true );
            xmlhttp.send();
        };
    </script>
</head>

<body>
    <?php
    include "elements/nav.php";
    if ( isset( $_POST[ "search" ] ) ) {
        echo "<body>";
        $search_arr = explode( "(", $_POST[ "search" ] );
        $search = $search_arr[ "0" ];



        $sql_kategori = "select kategori from kategori where kategori = '$search'";
        $sql_bruker = "select brukernavn from bruker where brukernavn = '$search'";

        $resultat_kategori = $kobling->query( $sql_kategori );
        $resultat_bruker = $kobling->query( $sql_bruker );

        if ( ( ( mysqli_num_rows( $resultat_kategori ) ) && ( mysqli_num_rows( $resultat_kategori ) ) ) > 0 ) {


            echo "Det finnes både en bruker og en kategori ved navn $search";
            echo "<form method='POST'>";
            echo "<button type='submit' value='$search' name='bruker'>Bruker: $search</button>";
            echo "<button type='submit' value='$search' name='kategori'>Kategori: $search</button>";
            echo "</form>";

        } elseif ( mysqli_num_rows( $resultat_kategori ) > 0 ) {


            include "elements/echo_innlegg.php";

            $sql_rest = "from innlegg 
                        join bruker on innlegg.bruker_id = bruker.bruker_id
                        join kategori on innlegg.innlegg_id = kategori.innlegg_id
                        where kategori = $search";

            echo_innlegg( $sql_rest );

        } elseif ( mysqli_num_rows( $resultat_bruker ) > 0 ) {

            echo "bruker";

        } else {
            echo "ingen søk matchet med det du skrev";
        }
    } elseif ( isset( $_POST[ "bruker" ] ) ) {
        echo "<body>";

        echo "bruker" . $_POST[ "bruker" ];


    } elseif ( isset( $_POST[ "kategori" ] ) ) {
        echo "<body>";
        $search = $_POST[ "kategori" ];

        include "elements/echo_innlegg.php";

        $sql_rest = "from innlegg 
                    join bruker on innlegg.bruker_id = bruker.bruker_id
                    join kategori on innlegg.innlegg_id = kategori.innlegg_id
                    where kategori = '$search'";

        echo_innlegg( $sql_rest );

    } else {
        echo "<body onload='searchArr()'>";
        include "elements/utforsk_search.php";
    }


    ?>


</body>
</html>