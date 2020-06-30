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
<div class="row d-flex mt-2 pl-4 mbot">
	<card class="list-group quizlist" title="<?=($_SESSION["user"] === "admin") ? "Mes quiz" : "Liste des quiz" ?>">
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

	
	<card class="quizlist mx-auto w-50" title="<?=$title?>">
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
                      <div class="card quiz">
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
                  <div>
                      <div class="row">
                          <div class="form-group col-md-6 mb-2">
                              <label class="required">Nom du Quiz</label>
                              <input type="text" name="quiz_name" class="form-control">
                          </div>
                          <div class="form-group col-md-6 mb-2">
                              <label class="required" style="font-weight: bold">Classes</label>
                              <select multiple name="classe_ids[]"  class="form-control">
                                  <?php foreach($classeList as $classe): ?>
                                      <option value="<?=$classe['id']?>"><?=$classe['nom']?></option>
                                  <?php endforeach;?>
                              </select>
                          </div>
                      </div>

                      <hr>
                      <h3 class="text-center col-md-10 font-weight-bold">Questions</h3>

                      <div id="divQuiz">

                          <div class="row">
                              <div class="form-group col-md-6 mb-2">
                                  <label class="control-label required">Nombre de questions à ajouter : </label>
                                  <input class="form-control" type="number" name="nombreQuestionSouhaite" v-model="nbQuestionSouhaite">
                              </div>
                              <div class="form-group col-md-6 mb-2">
                                  <button type="button" class="btn buttonAddQuestion btn-primary" v-on:click.self="addMultipleQuestions">Ajouter une question <i class="fa fa-plus"></i></button>
                              </div>
                          </div>

                          <div v-for="q in questions">
                              <div class="form-group col-md-10" style="text-align: center">
                                  <label class="control-label required font-weight-bold">
                                      Question {{q.numeroQuestion}}
                                  </label>
                                  <input class="form-control" type="text" :name="'question-' + q.numeroQuestion"/>
                              </div>

                              <div class="form-group ">
                                  <div v-for="n in q.numeroReponse">
                                      <div class="row">
                                          <label class="col-md-4 mb-2 required">
                                              Reponse {{n}}
                                          </label>
                                          <input class="form-control col-md-4 mb-2" type="text" :name="'reponse-' +q.numeroQuestion+'-'+ n"/>
                                          <label class="col-md-4 mb-2">Vrai ? <input type="checkbox" :name="'estvrai-'+ q.numeroQuestion +'-' + n" /></label>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <button type="button" class="btn btn-primary buttonsQuiz col-md-5 col-sm-4" v-on:click.self="addReponse" :name="q.numeroQuestion"><i class="fa fa-plus-circle"> réponse</i></button>
                                      <button type="button" class="btn btn-danger buttonsQuiz col-md-5 col-sm-4" v-on:click.self="removeReponse" :name="q.numeroQuestion"><i class="fa fa-minus-circle"> réponse</i></button>
                                  </div>
                                  <div class="row">
                                      <button type="button" class="btn btn-primary buttonsQuiz col-md-5 col-sm-4" v-on:click.self="addQuestion"><i class="fa fa-plus-circle"> question</i></button>
                                      <button type="button" class="btn btn-danger buttonsQuiz col-md-5 col-sm-4" v-on:click.self="removeQuestion" :name="q.numeroQuestion"><i class="fa fa-minus-circle"> question</i></button>
                                  </div>
                                  <hr>
                              </div>


                              <!--
                              <div class="form-group ">
                                  <div v-for="n in q.numeroReponse">
                                      <label class="control-label col-sm-4 required">
                                          Reponse {{n}}
                                      </label>
                                      <input class="col-sm-2" type="text" :name="'reponse-' +q.numeroQuestion+'-'+ n"/>
                                      <label class="col-sm-2">Vrai ? <input type="checkbox" :name="'estvrai-'+ q.numeroQuestion +'-' + n" /></label>
                                  </div>
                                  <button type="button" class="mx btn btn-primary ml-1 col-md-1 col-sm-2" v-on:click.self="addReponse" :name="q.numeroQuestion"><i class="fa fa-plus-circle"></i></button>
                                  <button type="button" class="mx btn btn-danger col-md-1 col-sm-2" v-on:click.self="removeReponse" :name="q.numeroQuestion"><i class="fa fa-minus-circle"></i></button>
                                  <button type="button" class="btn btn-primary ml-1 col-md-4 col-sm-2" v-on:click.self="addQuestion"><i class="fa fa-plus-circle"></i> question</button>
                                  <button type="button" class="mx btn btn-danger col-md-3 col-sm-2" v-on:click.self="removeQuestion" :name="q.numeroQuestion"><i class="fa fa-minus-circle"></i> question</button>
                                  <hr>
                              </div>
                               -->

                          </div>
						  <div class ="submit">
                              <input type="submit" class="btn btn-primary mt-4 col-md-5 col-sm-2" name="submit_quiz" value="Soumettre le quiz">
                          </div>	
                      </div>


                  </div>


	</div>
	
	<?php endif;?>
              <?php if($_SESSION['user'] === 'etudiant'): ?>
              	<div class ="submit">
                	<input type="submit" class="btn btn-primary mt-4 col-md-5 col-sm-2" name="submit_quiz">
                </div>
              <?php endif;?>
   
             </form>
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
<!-- package for the toast -->
<script src="https://cdn.jsdelivr.net/npm/vue-toast-notification"></script>
<link href="https://cdn.jsdelivr.net/npm/vue-toast-notification/dist/theme-default.css" rel="stylesheet">



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

<script
	src="/projetL3/application/views/page_template/components_vuejs/quiz.js"></script>

</body>


<footer class="page-footer font-small blue">
<div class="footer text-center py-3">
	<p>Ce site est reserve au partage des ressources pour le cours UX</p>
</div>
</footer>
