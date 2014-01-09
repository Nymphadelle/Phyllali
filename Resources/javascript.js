var glob;

//////////////////////////////////////////
//////////////// FONCTIONS ////////////////
//////////////////////////////////////////
$("#load").hide();
function validerInscription() {
	$.ajax({
  type: "POST",
  url: "ajax/insertionclient.php",
  data: { nom: $("#nom").val(), prenom: $("#prenom").val(), mail:$("#mail").val(), psw:$("#psw").val(), addr:$("#addr").val(), cp:$("#cp").val(), ville:$("#ville").val() }
})
  .done(function( msg ) {
      // run the currently selected effect
    $( "#effect" ).show( "highlight", {}, 500 );
     setTimeout(function() {
        $( "#effect:visible" ).removeAttr( "style" ).fadeOut();
		 $(location).attr('href',"index.php");
      }, 1500 );   
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
		 html = " 	  <div class=\"toggler\">";
		 html +=	  "<div id=\"effect\" class=\"ui-widget-content ui-corner-all\">";
		html +=	  "<h3 class=\"ui-widget-header ui-corner-all\">Effectu&eacute;</h3>";
		html +=	  "	  </div>";
		html +=	  "	</div>";
		$( "#presentation" ).html(html);



      // run the currently selected effect
    $( "#effect" ).show( "highlight", {}, 500 );
     setTimeout(function() {
        $( "#effect:visible" ).removeAttr( "style" ).fadeOut();
		 $(location).attr('href',"index.php");
      }, 1500 );   
  });
}

function ajoutProduit() {
	$.ajax({
  type: "POST",
  url: "ajax/ajouterproduit.php"
})
  .done(function( html ) {
		$( "#presentation" ).html(html);
  });
}

//////////////////////////////////////////
//////////////// HANDLERS ////////////////
//////////////////////////////////////////
// on cache par defaut
$("#effect").hide();

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
$('#presentation').on('click', '#Creerclient', function(event){
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






//handler sur le bouton annuler un souhait
//$("#annuler_souhait").unbind().click(function(event){
$('#presentation').on('click', '#annuler_souhait', function(event){
	// on annule le comportemet par défaut du bouton

	event.preventDefault();
	
	if (confirm('Etes-vous sur de vouloir suprimmer ce souhait ?')) {
		$.ajax({
			type:"POST",
			url:"ajax/listeSouhaits.php",
			data:{souhaits:"3", id_troc:$(".btn_anul").attr("id")}
		})
		.done(function(html){
			$("#presentation").html(html);
				$("#load").hide();
		})
	} else {
		// Do nothing!
	}
	
		
});

// handler sur le bouton valider un souhait
$('html').unbind().on('click', '#valider_souhait', function(event){
	// on annule le comportemet par défaut du bouton
	event.preventDefault();
	var valeurs = [];
	$(function(){
		tabval=new Array();
		tabval = $(".check_pdt:checkbox:checked").map(function(){ return $(this).val()}).get()
		
		tabmodes = new Array();
		tabmodes = $(".check_modes:checkbox:checked").map(function(){ return $(this).val()}).get()
	} )
	
	if(tabval.length>0 && tabmodes.length>0){
	
	$.ajax({
		type:"POST",
		url:"ajax/souhaitFini.php",
		data:{liste_pdts:tabval, liste_modes:tabmodes}
	})
	.done(function( html ) {
		$( ".Aff_Produits" ).html(html);
	});
	}else if(tabval.length==0){
		alert("Veuillez sélectionner au moins un produit");
	}else{
		alert("Veuillez sélectionner au moins un mode de livraison");
	}
});


// handler sur le bouton ajouter un produit
$('body').on('click', '#ajouter', function(event){
	// on annule le comportemet par défaut de l'ancre
	event.preventDefault();
	ajoutProduit();	
});

// bouton connexion
$("#connexion").unbind().click(function(event) {
	console.log('event connexion');
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
		 $(location).attr('href',"index.php");
	});
});



// handler sur le bouton ajouter un produit
$('body').on('click', '.vignette', function(event){
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

$('html').on('click', '.vignette_index', function(event){
// appel de la page afficheProduit.php
alert();
 	$.ajax({
	  type:"GET",
	  url: "ajax/afficheProduit.php",
	  data: {id_pdt: this.id}
	})
  .done(function( html ) {
		// si l'appel a reussi, on affiche le résultat
		$("#presentation").html(html);
  });
});

//appel la fiche du produit depuis la liste des produits actifs d'un utilisateur
$('body').on('click', '.pdtactif', function(event){
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

// Clic sur une catégorie
$(".cat").click(function() {
	$("#load").show();
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

// Clic sur une sous categorie
$(".sous_cat").click(function() {
	$("#load").show();
 	$.ajax({
	  type:"GET",
	  url: "ajax/sousCategProduit.php",
	  data: {id_categ: this.id}
	})
	.done(function( html ) {
		$( ".Aff_Produits" ).html(html);
			$("#load").hide();
  });
});




$("body").on('click', "#listeSouhaits", function(event){
	$("#load").show();
	$.ajax({
		url:"ajax/listeSouhaits.php"
	})
	.done(function(html) {
		$("#presentation").html(html);
			$("#load").hide();
	})
});


$("body").on('click', ".vignettearchive", function(event){
		$.ajax({
		url:"ajax/activerproduit.php",
		data: {id:this.id}
	})
	.done(function(html) {
		$("#presentation").html(html);
	})
});

$("body").on('click', "#historique", function(event){
	$("#load").show();
	$.ajax({
		url:"ajax/historique.php"
	})
	.done(function(html) {
		$("#presentation").html(html);
			$("#load").hide();
	})
});

// clic sur le nom du propriétaire d'un produit > affiche la liste de ses produits
$(".proprietaire").click(function() {
	$.ajax({
		type:"POST",
		url:"ajax/listeSouhaits.php",
		data:{souhaits:2, util:$(".proprietaire").attr("id")}
	})
	.done(function(html){
		$("#presentation").html(html);
		$("#ListerSouhaits").hide();
	})
});

// bouton ficheSouhait
$("#souhaiter").click(function() {
	$.ajax({
		
		url:"ajax/ficheSouhait.php",
		
		data:{idPdtVoulu:$(".pdt").attr("id"), util_id:$(".proprietaire").attr("id")}
	})
	.done(function( html ) {
		// si l'appel a reussi, on affiche le résultat
		$( ".Produit" ).html(html);
		
		});
});
$("body").on('click', ".mesSouhaits", function(event){
	$("#load").show();
	event.preventDefault();
	$.ajax({
		type:"POST",
		url:"ajax/listeSouhaits.php",
		data:{souhaits:$(this).data("type")}
	})
	.done(function(html){
		glob = html;
		$("#presentation").html(html);
			$("#load").hide();
	})
});

$("body").on('click', "#btnTroc", function(event){
	$("#presentation").html(glob);
});


$("body").on('click', ".proprio", function(event){
	event.preventDefault();
	$.ajax({
		type:"POST",
		url:"ajax/profilUtil.php",
		data:{id_proprio:$(this).data("proprio")}
	})
	.done(function(html){
		$("#presentation").html(html);
	})
});

$("body").on('click', ".noterutil", function(event){
	event.preventDefault();
	console.log("id de la cible :"+$("#uticible").val());
	chaine = "#uticible"+this.id;
	$.ajax({
		type:"POST",
		url:"ajax/formnote.php",
		data:{troc:this.id,uti:$(chaine).val()}
	})
	.done(function(html){
		$("#presentation").html(html);
	})
});


$("body").on('click', "#envoyernote", function(event){
	event.preventDefault();
	$.ajax({
		type:"POST",
		url:"ajax/insertionnote.php",
		data:{note:$('#note').find(":selected").text(),com:$("#commentaire").val(),uti:$("#idcible").val(),troc:$("#troc").val()}
	})
	.done(function(html){
		console.log(html);
	})
});

$("body").on('click', ".afficherprofil", function(event){
	event.preventDefault();
		$.ajax({
		type:"POST",
		url:"ajax/getNotes.php",
		data:{id:this.id}
	})
	.done(function(html){
		$("#presentation").html(html);
	})
});

$("body").on('click', ".btn_final", function(event){
	event.preventDefault();
	$.ajax({
		type:"POST",
		url:"ajax/finaliserTroc.php",
		
		data:{idtroc:$('.btn_final').attr('data-troc'), idutil:$('.btn_final').attr('data-util'), idprod:$('.btn_final').attr('data-produit')}
	})
	.done(function( html ) {
		// si l'appel a reussi, on affiche le résultat
		$( "#presentation" ).html(html);
})
});



$("body").on('click', ".btn_finalTroc", function(event){
	event.preventDefault();
	$pdt = $('.radioTroc:checked').val();
	$livr = $('.radioLivr:checked').val();
	if($pdt != null && $livr != null){
		$.ajax({
			type:"POST",
			url:"ajax/trocConfirme.php",
			
			data:{idtroc:$('.btn_finalTroc').attr('data-troc'), pdt:$pdt, livr:$livr }
		})
		.done(function( html ) {
			// si l'appel a reussi, on affiche le résultat
			$( "#presentation" ).html(html);
		});
	}
	else{
		alert("Vous devez choisir un produit et un mode de livraison");
	}

});