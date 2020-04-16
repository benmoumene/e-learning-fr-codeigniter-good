<?php
$this->load->view("page_template/header");

/* sert a stocker les question du quiz selectionné */
$questions = array();
/*
 * evaluation sert a determiner si le quiz a deja ete fait
 * par l'eleve, si il a ete fait par l'eleve on affiche
 * le score
 */
$evaluation = null;
if (isset($_GET['quiz'])) {
    $questions = $this->QuizDAO->getQuestionsByQuizId($_GET['quiz']);
    if ($_SESSION['user'] === 'etudiant') {
        $evaluation = $this->EvaluationDAO->getEvaluationByQuizAndByEleve($_GET['quiz'], $this->EleveDAO->getIdByEmail($this->encrypt->decode(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))));
    }
}
?>

<div class="d-flex mt-2 mb-4">
	<div class="card p-2 mr-4">
		<div class="card-body">
			<h2 class="card-title"><?=($_SESSION["user"] === "admin") ? "Mes cours" : "Les cours de l'enseignante" ?></h2>
			<div class="list-group mb-2">
      <?php foreach ($coursList as $cours): ?>
      		  <list-item
					lien="/projetL3/index.php/enseignements?cours=<?=$cours['id']?>"
					titre="<?=$cours['intitule']?>" description="Description du cours"
					class="coursIntitule"></list-item>	
  	<?php endforeach;?>
		</div>
		</div>
	</div>


	<div class="card p-2 mr-4 w-50">
		<div class="card-body">
		<?php foreach ($coursList as $cours):?>
		    <?php if(isset($_GET['cours']) && $cours['id'] === $_GET['cours']): ?>
		       <h2 class="card-title mb-4"><?=$cours["intitule"]?></h2>
		    <?php endif;?>
		<?php endforeach;?>
		<div class="list-group documents">
     	 <?php foreach($documents as $document):?>
              <?php if(isset($_GET['cours']) && $document['cours_id'] == $_GET['cours']): ?>    
                  <list-item lien="<?=$document["path"]?>"
					titre="<?=$document["nom"]?>" description=""
					class="ml-4 documents documentsCours<?=$document['cours_id']?>"></list-item>	
              <?php endif;?>
          <?php endforeach;?>
          
          <?php if(isset($_GET['quiz'])): ?>
 			<?php if(empty($evaluation)): ?>       
              <?php
                  if($_SESSION['user'] === 'admin'){
                      echo form_open('/EnseignementsController/saveNewQuiz');
                  }
                  else{
                    echo form_open('/EnseignementsController/checkQuizAnswers');
                  }
                ?>
                  <input type="text" name="quiz_id" value="<?=$_GET['quiz']?>" hidden /> 
				  <input type="text" name="nombre_question" value="<?=sizeof($questions)?>" hidden />
                  <?php foreach($questions as $question):?>
                      <div class="card">
					<h4 class="card-title"><?=$question['intitule']?></h4>
                      	<?php $reponses = $this->QuizDAO->getReponsesByQuestionId($question['id']);?>
                      	
                  
                          	<?php foreach($reponses as $reponse): ?>
                          		<div class="radio">
						<label><?=$reponse["contenu"]?>
                                  	<input type="radio"
							name="optradio<?=$question['id'].'-'.$reponse['id']?>"
							<?=($_SESSION['user'] === 'admin' && $reponse['estVrai'] == 1) ? "checked" : ""?>>
						</label>
					</div>
                          	<?php endforeach;?>
                          	</div>
                          	
                  <?php endforeach;?>
                  	
                  	
                  	<?php if($_GET['quiz'] === 'add'): ?>
						<label class="required">Nom du Quiz</label>
						<input type="text" name="quiz_name"><br>
						
						<label class="required" style="font-weight:bold">Classes</label>
                    	<select name="classe_ids[]" multiple>
                    		<?php foreach($classeList as $classe): ?>
                    			<option value="<?=$classe['id']?>"><?=$classe['nom']?></option>
                    		<?php endforeach;?>
                    	</select><br><br>
						
						<h3>Questions</h3>
						<label class="required">Question 1</label>
						<input type="text" name="question 1" class="questionInput"><br><br>
						
							<label class="required">Reponse 1</label>
    						<input type="text" name="reponse-1-1"> <label>Vrai ?</label>
    						<input type="radio" name="estvrai-1-1"/><br>
    					
    						<label class="required">Reponse 2</label>
    						<input type="text" name="reponse-1-2"> 
    						<label>Vrai ?</label>
    						<input type="radio" name="estvrai-1-2"/><br>
    						
						<button class="btn btn-primary mt-4 col-md-5 col-sm-2 addReponse">Ajouter une reponse</button>                  
                  		<button class="btn btn-primary mt-4 col-md-5 col-sm-2 addQuestion">Ajouter une question</button>                  
                  	<?php endif;?>
                  	<input type="submit"
					class="btn btn-primary mt-4 col-md-5 col-sm-2" name="submit_quiz">
                  
                  <?php
                echo form_close();
                ?>
                <?php else: ?>
                	<h2 class="card-title">Résultat</h2>
				<p><?=$evaluation[0]["note"]?></p>
             <?php endif;?>
          <?php endif;?>
		</div>
		</div>
	</div>

	<div class="card p-2 ml-auto ">
		<div class="card-body">
			<h2 class="card-title"><?=($_SESSION["user"] === "admin") ? "Mes quiz" : "Liste des quiz" ?></h2>
	<?php if(sizeof($quizzes) === 0): ?>
		<p>Pas encore de quiz diponible</p>
		<?php else: ?>
		<div class="list-group group2">
        <?php foreach ($quizzes as $quiz): ?>
          		  <list-item lien="/projetL3/index.php/enseignements?quiz=<?=$quiz['id']?>" titre="<?=$quiz['nom']?>" description="Description du cours"></list-item>	
        <?php endforeach;?>
        <?php if($_SESSION['user'] === 'admin'): ?>
        		<list-item lien="/projetL3/index.php/enseignements?quiz=add" titre="+" description=""></list-item>
		<?php endif;?>
		</div>
	<?php endif;?>
</div>
	</div>

</div>

<script
	src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>

<script>
	/* variable qui vont nous servir a distinguer les different input pour les question 
	et reponses */
	var cptReponse = 3;
    var cptQuestion = 1;

    //on ecoute le click du bouton 'ajouter une reponse'
	var boutonReponse = document.querySelector('.addReponse');
	boutonReponse.addEventListener('click', ajoutReponse);

	//on ecoute le click du bouton 'ajouter une question'
	var boutonQuestion = document.querySelector('.addQuestion');
	boutonQuestion.addEventListener('click', ajoutQuestion);

	function ajoutQuestion(e){
		e.preventDefault();
		cptReponse = 1;
		cptQuestion++;
		/*On cree les elements necessaires à l'ajout d'une question*/
		let labelQuestion = document.createElement("label");
		labelQuestion.classList = "required";
		labelQuestion.innerHTML = "Question "+cptQuestion;

		let inputTextQuestion = document.createElement("input");
		inputTextQuestion.type = "text";
		inputTextQuestion.name = "question_"+cptQuestion;
		inputTextQuestion.classList = "questionInput";

		let br = document.createElement("br");
		
		let documents = document.querySelector('.documents');
		documents.children[0].insertBefore(br, boutonReponse);
		documents.children[0].insertBefore(labelQuestion, boutonReponse);
		documents.children[0].insertBefore(inputTextQuestion, boutonReponse);
		documents.children[0].insertBefore(br, boutonReponse);

	}
	
	function ajoutReponse(e){
		e.preventDefault();

		/*On cree les elements necessaires à l'ajout d'une reponse*/
		let labelReponse = document.createElement("label");
		labelReponse.classList = "required";
		labelReponse.innerHTML = "Reponse "+cptReponse;

		let labelVrai = document.createElement("label");
		labelVrai.innerHTML = "Vrai ?";
		
		let inputTextReponse = document.createElement("input");
		inputTextReponse.type = "text";
		inputTextReponse.name = "reponse-"+cptQuestion+"-"+(cptReponse);

		let inputRadio = document.createElement("input");
		inputRadio.type = "radio";
		inputRadio.name = "estvrai-"+cptQuestion+"-"+(cptReponse++);		
		
		let br = document.createElement("br");

		//on ajoute les elements pour une nouvelle reponse
		let documents = document.querySelector('.documents');
		documents.children[0].insertBefore(labelReponse, this);		
		documents.children[0].insertBefore(inputTextReponse, this);
		documents.children[0].insertBefore(labelVrai, this);
		documents.children[0].insertBefore(inputRadio, this);
		documents.children[0].insertBefore(br, this);
	}
</script>


<style>
 .questionInput{
    margin-top: 20px;
    margin-bottom : 20px;
 }   
</style>

<?php $this->load->view("page_template/footer");?>

<script>
Vue.use(VueToast);
if('<?=$_SESSION['creation_quiz']?>' === 'Veuillez renseigner les champs'){
    Vue.$toast.error('<?=$_SESSION['creation_quiz']?>', {
    	  position: 'top',
    	  duration: 8000	  
    })
}
else if('<?=$_SESSION['creation_quiz']?>' === 'Le quiz a été crée'){
    Vue.$toast.success('<?=$_SESSION['creation_quiz']?>', {
    	  position: 'top',
    	  duration: 8000	  
    })
}
</script>

</body>