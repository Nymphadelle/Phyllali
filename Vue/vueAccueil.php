
	


<div id="presentation">
<h1> Troc en ligne</h1>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </br>
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
</div>

produits...</br>

<?php

$j=0;
while(odbc_fetch_row($produits)){
	$j++;
	echo "Produit n°".$j." : ";
    for($i=1;$i<=odbc_num_fields($produits);$i++){
        echo ", ".odbc_result($produits,$i);
    }
	echo "</br>";
	}
?>
</div>

