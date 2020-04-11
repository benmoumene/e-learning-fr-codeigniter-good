<?php
$this->load->view("page_template/header");
?>

<div class="card" style="width: 60%; margin: 20px auto; margin-bottom: 100px;">
	<div class="card-body">
		<h2 class="card-title"><?=($_SESSION["user"] === "admin") ? "Mes cours" : "Les cours de l'enseignante" ?></h2>
		<div class="list-group">
      <?php foreach ($coursList as $cours): ?>
      		  <list-item lien="index.php?cours=<?=$cours['id']?>" titre="<?=$cours["intitule"]?>" description="Description du cours" class="coursIntitule"></list-item>	
         <?php foreach($documents as $document):?>
              <?php if($document['cours_id'] == $cours['id']): ?>    
                  <list-item style="display: none;" lien="<?=$document["path"]?>" titre="<?=$document["nom"]?>" description="" class="ml-4 documents documentsCours<?=$document['cours_id']?>"></list-item>	
              <?php endif;?>
          <?php endforeach;?> 
  	<?php endforeach;?>
		</div>
	</div>
</div>


<script src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>

<script>
	const intitules = document.querySelectorAll(".coursIntitule");
 	var isClicked = false;
 	var elementClicked;
	
	for(let i=0; i<intitules.length; i++){
    		intitules[i].addEventListener("click", function(){
    		event.preventDefault(intitules[i]);

    		if(isClicked && elementClicked === intitules[i]){ 
        		reinit();
				isClicked = false;
            }

    		else{
        		isClicked = true;
        		elementClicked = intitules[i];
        		button = intitules[i];
        		//reinitialisation de l'affichage des documents
    			reinit();
    
            	//on prend le numero du cours sur lequel on vient de cliquer
        		var numeroCours = intitules[i].href.substring(intitules[i].href.indexOf("=")+1);
        		let documents = document.querySelectorAll(".documentsCours"+numeroCours);
    
        		//on affiche les documents associes au cours sur lequel on vient de clique 
    			for(let k=0; k<documents.length; k++){
    				documents[k].style.display = "";
    			}
    		}
    	});
	}

	function reinit(){
		let allDocuments = document.querySelectorAll(".documents");	
		for(let j=0; j<allDocuments.length; j++){
			allDocuments[j].style.display = "none";
    	}
	}
	
</script>

<?php $this->load->view("page_template/footer");?>
</body>