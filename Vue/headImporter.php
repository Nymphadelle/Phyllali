<!doctype html>
<html>

<head>
<link href="Contenu/style.css" type="text/css" media="screen" rel="stylesheet">
<script type="text/javascript" src="Contenu/jquery-1.8.2.min.js"></script>
<title><?= $titre ?></title>
</head>
<body>


<div class="connectUtilisateur">
<div id="titre">
<img src="resources/images/titre.png" alt="" />
</div>
<div id = "recherche">
<input type="text" value="Recherche" size="50px">
</div>
<div id ="compte">
Identifiant : <input type="text" value="pseudo.." >
Mot de passe : <input type="text" value="******" >
</div>

</div>
<div class="content">
	

	<div class="bandeau">
		
		
	</div>






<div id = "navigation_menu">
<ul>
<li> <a href="index.html"><img src="resources/nav/jeux.png" /></a></li>
<li> <a href="index.html"><img src="resources/nav/car.png"  alt="" /></a></li>
<li> <a href="index.html"><img src="resources/nav/fournitures.png"  alt="" /></a></li>
<li> <a href="index.html"><img src="resources/nav/mobilier.png"  alt="" /></a></li>
<li> <a href="index.html"><img src="resources/nav/clothes.png"  alt="" /></a></li>
<li> <a href="index.html"><img src="resources/nav/multi.png"  alt="" /></a></li>
</ul>
</div>
<div id="contenu">
	<?= $contenu ?>
</div>
	
	

</body>
</html>