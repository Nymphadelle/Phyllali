//////////////////////////////////////////
//////////////// FONCTIONS ////////////////
//////////////////////////////////////////
function validerInscription() {
	$.ajax({
  type: "POST",
  url: "ajax/insertionclient.php",
  data: { nom: $("#nom").val(), prenom: $("#prenom").val(), mail:$("#mail").val(), psw:$("#psw").val(), addr:$("#addr").val(), cp:$("#cp").val(), ville:$("#ville").val() }
})
  .done(function( msg ) {
    console.log( "Data Saved: " + msg );
  });
}

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
	validerInscription();
});



// bouton connexion
$("#connexion").click(function() {
  alert('connexion');
});


$(".cat").click(function() {
// appel de la page creaclient.php
//alert(this.id);
 	$.ajax({
	  type:"GET",
	  url: "ajax/categProduit.php",
	  data: {id_categ: this.id}
	})
  .done(function( html ) {
		// si l'appel a reussi, on affiche le résultat
		$( "#presentation" ).html(html);
  });
 
});
