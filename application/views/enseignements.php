<?php $this->load->view("page_template/header"); 

//on recupere les id des cours de chaque document
$idsCours = array();
foreach($documents as $document){
    array_push($idsCours, $document['cours_id']);    
}
?>

<div class="list-group">
  
  <?php foreach ($coursList as $cours): ?>
          <a href="index.php?cours=<?=$cours['id']?>" class="list-group-item list-group-item-action flex-column align-items-start coursIntitule">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1"><?=$cours["intitule"]?></h5>
              <small>3 days ago</small>
            </div>
            <p class="mb-1">Description du cours</p>
          </a>
      
     <?php foreach($documents as $document):?>
          <?php if($document['cours_id'] == $cours['id']): ?>    
              <a href="<?=$document["path"]?>" class="list-group-item list-group-item-action flex-column align-items-start ml-4 documents documentsCours<?=$document['cours_id']?>" style="display: none;">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1"><?=$document["nom"]?></h5>
                </div>
              </a>
          <?php endif;?>
      <?php endforeach;?>
      
  <?php endforeach;?>
</div>


<script>
	
	const intitules = document.querySelectorAll(".coursIntitule");

	for(let i=0; i<intitules.length; i++){
    	intitules[i].addEventListener("click", function(){
    		event.preventDefault(intitules[i]);

    		//reinitialisation de l'affichage des documents
			let allDocuments = document.querySelectorAll(".documents");	
    		for(let j=0; j<allDocuments.length; j++){
    			allDocuments[j].style.display = "none";
        	}

        	//on prend le numero du cours sur lequel on vient de cliquer
    		var numeroCours = intitules[i].href.substring(intitules[i].href.indexOf("=")+1);
    		let documents = document.querySelectorAll(".documentsCours"+numeroCours);

    		//on affiche les documents associes au cours sur lequel on vient de clique 
			for(let k=0; k<documents.length; k++){
				documents[k].style.display = "";
			}
			
    	});
	}
</script>

<?php $this->load->view("page_template/footer");?>
</body>