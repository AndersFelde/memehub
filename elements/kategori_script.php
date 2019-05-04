<script>
    var kat_nr = 1;

    function addKategori() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if ( this.readyState == 4 && this.status == 200 ) {

                var input = document.getElementById( "input" );

                var input_cln = input.cloneNode( true );
                input_cln.value = "";
                input_cln.name = "kategori" + kat_nr;

                var form = document.getElementById( "form" );

                var button = document.getElementById( "add_kategori" )

                var br = document.createElement( "br" );

                if ( kat_nr < 4 ) {

                    form.insertBefore( input_cln, button );
                    form.insertBefore( br, button );

                    kat_nr++;
                } else {

                    form.insertBefore( input_cln, button );
                    form.insertBefore( br, button );


                    var elem = document.getElementById( "add_kategori" );
                    elem.style.display = 'none';

                }
            }
        }
        console.log( "elements/insert_vote.php?v='" + vote + "'&b='" + b + "'&inn='" + inn + "'&type='" + type + "'" );
    xmlhttp.open( "GET", "elements/insert_vote.php?v='" + vote + "'&b='" + b + "'&inn='" + inn + "'&type='" + type + "'", true );
    xmlhttp.send();
    };
    
</script>