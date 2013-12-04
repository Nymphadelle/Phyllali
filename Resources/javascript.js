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
    $(location).attr('href',"index.php");
  });
}

function modifProfil() {
	$.ajax({
  type: "POST",
  url: "ajax/getclient.php"
})
  .done(function( html ) {
		$( "#presentation" ).html(html);
  });
}

function validerProfil() {
	$.ajax({
  type: "POST",
  url: "ajax/majclient.php",
  data: { nom: $("#nom").val(), prenom: $("#prenom").val(), addr:$("#addr").val(), cp:$("#cp").val(), ville:$("#ville").val() }
})
  .done(function() {
    $(location).attr('href',"index.php");
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
	if ($('#nom').val() == '' || $('#prenom').val() == '' || $('#mail').val() == '' || $('#psw').val() == '' || $('#addr').val() == '' || $('#cp').val() == '' || $('#ville').val() == '' ) {
		alert('tous les champs doivent être remplis.');
		return;		
	}
	// si les 2 mails ne correspondent pas
	if ($('#mail').val() != $('#mail2').val()) {
		alert('les mails ne correspondent pas');
		return;
	}
	validerInscription();
});

// handler sur le bouton envoyer (utilisation de delegates car le bouton est jouté dynamiquement)
$('#annuler').on('click', '#envoyer', function(event){
	// on annule le comportemet par défaut du bouton
	event.preventDefault();
	$(location).attr('href',"index.php");
});

// handler sur l'ancre modifier profil utilisateur
$('body').on('click', '#modpro', function(event){
	// on annule le comportemet par défaut de l'ancre
	event.preventDefault();
	modifProfil();
});

// handler sur l'ancre modifier profil utilisateur
$('body').on('click', '#validerModifInfos', function(event){
	// on annule le comportemet par défaut de l'ancre
	event.preventDefault();
	validerProfil();
});



// bouton connexion
$("#connexion").click(function() {
	event.preventDefault();
	$.ajax({
		type:"POST",
		url:"ajax/conneclient.php",
		data:{email:$("#email").val(), mdp:$("#mdp").val()}
	})
	.done(function( html ) {
		if(html == -1){
			alert("Login ou mot de passe incorrect");
			return;
		}
		$('#compte').html('Bonjour '+html);
		$("<div id='picto'><a id='modpro' title='Modifier profil'> M </a><a title='Ajouter produit'> A </a><a title='Liste de souhaits'> S </a></div>").insertAfter('#compte');
		$('#buttons').html('<form method="POST" action="ajax/decoclient.php"><input type="submit" id="deconnexion" value="D&eacute;connexion"></form>');
	});
});

$(".vignette").click(function() {
// appel de la page afficheProduit.php
 	$.ajax({
	  type:"GET",
	  url: "ajax/afficheProduit.php",
	  data: {id_pdt: this.id}
	})
  .done(function( html ) {
		// si l'appel a reussi, on affiche le résultat
		$( ".Aff_Produits" ).html(html);
  });
});

$(".cat").click(function() {
// appel de la page categProduit.php
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




