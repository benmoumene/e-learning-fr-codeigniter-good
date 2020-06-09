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


//on defini le titre de la section au centre
//en fonction de l'élément sélectionné(Quiz ou Cours)
$title = '';
if(!empty($_GET['quiz_name'])){
    $title = $_GET['quiz_name'];
}
else if(!empty($coursSelectionne)){
    $title = $coursSelectionne['intitule'];
}

$title = strtoupper($title);

?>

<div class="d-flex mt-2 mb-4">
	<card class="" title="<?=($_SESSION["user"] === "admin") ? "Mes quiz" : "Liste des quiz" ?>">
    	<?php if($_SESSION['user'] === 'admin'): ?>
            		<list-item lien="/projetL3/index.php/quiz?quiz=add"
    					titre="Ajouter un quiz" description=""></list-item>
    		<?php endif;?>
    	
    	<?php if(sizeof($quizzes) === 0): ?>
    		<p>Pas encore de quiz diponible</p>
    		<?php else: ?>
    		<div class="list-group group2">
            <?php foreach ($quizzes as $quiz): ?>
              		  <list-item
    					lien="/projetL3/index.php/quiz?quiz=<?=$quiz['id']?>&quiz_name=<?=$quiz['nom']?>"
    					titre="<?=$quiz['nom']?>" description="Description du cours"></list-item>	
            <?php endforeach;?>
            
    		</div>
    	<?php endif;?>
    	
	</card>	

	
	<card class="p-2 ml-4 w-50 " title="<?=$title?>">
	<div class="list-group documents">
     
          <?php if(isset($_GET['quiz'])): ?>
 			<?php if(empty($evaluation)): ?>       
                  
              <?php if(!empty($_GET['quiz_name']) && $_SESSION['user']==='admin'):?>
              	<?php echo form_open('/QuizController/removeQuiz');?>
              	<input type="text" name="quiz_id" value=<?=$_GET['quiz']?> hidden/>
              	<button class="btn btn-danger mb-4 col-md-1 col-sm-2 deleteQuiz" onclick="return confirm('Etes vous sur de vouloir supprimer ce quiz?')"><i class="fa fa-trash" style="font-size:30px;"></i></button>
              	<?php form_close();?>
              <?php endif;?>

              <?php
                if ($_SESSION['user'] === 'admin') {
                    echo form_open('/QuizController/saveNewQuiz');
                } else {
                    echo form_open('/QuizController/checkQuizAnswers');
                }
                ?>
                
                  <input type="text" name="quiz_id"
			value="<?=$_GET['quiz']?>" hidden /> <input type="text"
			name="nombre_question" value="<?=sizeof($questions)?>" hidden />
                  
                  <?php foreach($questions as $question):?>
                      <div class="card">
			<h4 class="card-title"><?=$question['intitule']?></h4>
                      	<?php $reponses = $this->QuizDAO->getReponsesByQuestionId($question['id']);?>
                      	
                          	<?php foreach($reponses as $reponse): ?>
                          		<div class="checkbox">
				<label><?=$reponse["contenu"]?>
                                  	<input type="checkbox"
					name="optradio<?=$question['id'].'-'.$reponse['id']?>"
					<?=($_SESSION['user'] === 'admin' && $reponse['estVrai'] == 1) ? "checked" : ""?>>
				</label>
			</div>
                          	<?php endforeach;?>
                          	</div>
                          	
                  <?php endforeach;?>
                  	
                  	
                  	<?php if($_GET['quiz'] === 'add'): ?>
						<label class="required">Nom du Quiz</label> <input type="text"
			name="quiz_name"><br> <label class="required"
			style="font-weight: bold">Classes</label> <select name="classe_ids[]"
			multiple>
                    		<?php foreach($classeList as $classe): ?>
                    			<option value="<?=$classe['id']?>"><?=$classe['nom']?></option>
                    		<?php endforeach;?>
                    	</select><br>
		<br>

		<h3>Questions</h3>
		<label>Nombre de questions à ajouter : </label>
		<input type="number" name="nombreQuestionSouhaite" class="nombreQuestionSouhaite">
		<button class="btn btn-primary col-md-1 col-sm-2 nombreQuestions"><i class="fa fa-plus" onclick="this.parentNode.click()"></i></button><br>
		
		<label class="required font-weight-bold">Question 1</label> <input type="text"
			name="question 1" class="questionInput">
		<br><label class="required labelreponse-1-1">Reponse 1</label> <input type="text"
			name="reponse-1-1"> <label class="labelcheckbox-1-1">Vrai ?</label> <input type="checkbox"
			name="estvrai-1-1" /><br><label class="required labelreponse-1-2">Reponse 2</label> <input
			type="text" name="reponse-1-2"> <label class="labelcheckbox-1-2">Vrai ?</label> <input
			type="checkbox" name="estvrai-1-2" />

		<button class="btn btn-primary ml-1 col-md-1 col-sm-2 addReponse addReponse-1-2"><i class="fa fa-plus-circle" onclick="this.parentNode.click()"></i></button>
		<button class="btn btn-danger col-md-1 col-sm-2 removeReponse removeReponse-1-2"><i class="fa fa-minus-circle" onclick="this.parentNode.click()"></i></button>	
		<br>
		<button class="btn btn-primary mt-4 col-md-5 col-sm-2 addQuestion addQuestion-1"><i class="fa fa-plus" onclick="this.parentNode.click()"></i> question</button>
		<button class="btn btn-danger mt-4 col-md-5 col-sm-2 removeQuestion removeQuestion-1"><i class="fa fa-minus" onclick="this.parentNode.click()"></i> question</button><br>  	                  
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
		
		
	</card>


</div>

<style>
.questionInput {
	margin-top: 20px;
	margin-bottom: 20px;
}
</style>

<script
	src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>
<script
	src="/projetL3/application/views/page_template/components_vuejs/card.js"></script>


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

<script src="/projetL3/application/views/page_template/add_quiz"></script>

</body>