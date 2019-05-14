var inputs = document.querySelectorAll( '.HideInput' );
Array.prototype.forEach.call( inputs, function( input )
{
  var label	 = input.nextElementSibling,
  labelVal = label.innerHTML;

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';

		if( fileName ) {
			label.querySelector( 'span' ).innerHTML = fileName;
    } else {
			label.innerHTML = labelVal;
    }
	});
});
