<?php
echo('test');
<?= "produit.php?PDT_ID=" . $produit['PDT_ID'] ?>
<?= $produit['LIBELLE_PDT'] ?>
while(odbc_fetch_row($produits)){
         for($i=1;$i<=odbc_num_fields($produits);$i++){
        echo "Result is ".odbc_result($produits,$i);
    }
	}
?>