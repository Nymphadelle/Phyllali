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

//formulaire pour ajouter un objet
$('html').on('click', '#ajouter', function(event){
	// on annule le comportemet par défaut du bouton
	event.preventDefault();
	$.ajax({
		type:"POST",
		url:"ajax/ajouterproduit.php"
	})
	.done(function( html ) {
		$("#presentation").html(html);
	});
});

//insérer un objet
$('html').on('click', '#valider_objet', function(event){
	$.ajax({
		type:"POST",
		url:"ajax/insererproduit.php",
		data:{libele:$("#libelle").val(), cat:$("#cat").val(), description:$("#description").val(), etat:$("#etat").val(), delai:$("#delai").val(), photo:$("#photo").val()}
	})
	.done(function( html ) {
		$(location).attr('href',"index.php");
	});
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




