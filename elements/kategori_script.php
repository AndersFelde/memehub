<script>
    var kat_nr = 1;

    function addKategori() {

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
    };
    
</script>