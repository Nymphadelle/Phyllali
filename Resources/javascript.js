// FONCTIONS


// HANDLERS
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

// bouton connexion
$("#connexion").click(function() {
  alert('connexion');
});