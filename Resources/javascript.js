//////////////////////////////////////////
//////////////// FONCTIONS ////////////////
//////////////////////////////////////////

//////////////////////////////////////////
//////////////// HANDLERS ////////////////
//////////////////////////////////////////
// clic bouton enregistrer
$("#enregistrer").click(function() {
	// appel de la page creaclient.php
	$.ajax({
	  url: "ajax/creaclient.php"
	})
	  .done(function( html ) {
		// si l'appel a reussi, on affiche le résultat
		$( "#presentation" ).html(html);
  });
});

// handler sur le bouton envoyer (utilisation de delegates car le bouton est jouté dynamiquement)
$('#presentation').on('click', '#envoyer', function(event){
	// on annule le comportemet par défaut du bouton
	event.preventDefault();
	// si les 2 mails ne correspondent pas
	if ($('#mail').val() != $('#mail2').val()) {
		alert('pb mail');
		return;
	}
	
	alert('validation formulaire');
});



// bouton connexion
$("#connexion").click(function() {
  alert('connexion');
});


