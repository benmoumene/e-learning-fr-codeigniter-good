<?php
$this->load->view("page_template/header");

$questions = array();
if(isset($_GET['quiz'])){
    $questions = $this->QuizDAO->getQuestionsByQuizId($_GET['quiz']);
    
}

?>

<div class="d-flex mt-2 mb-4">
<div class="card p-2 mr-4" >
	<div class="card-body">
		<h2 class="card-title"><?=($_SESSION["user"] === "admin") ? "Mes cours" : "Les cours de l'enseignante" ?></h2>
		<div class="list-group mb-2">
      <?php foreach ($coursList as $cours): ?>
      		  <list-item lien="/projetL3/index.php/enseignements?cours=<?=$cours['id']?>" titre="<?=$cours['intitule']?>" description="Description du cours" class="coursIntitule"></list-item>	
  	<?php endforeach;?>
		</div>
	</div>
</div>


<div class="card p-2 mr-4 w-50" style="background-color: white;">
	<div class="card-body">
		<?php foreach ($coursList as $cours):?>
		    <?php if(isset($_GET['cours']) && $cours['id'] === $_GET['cours']): ?>
		       <h2 class="card-title mb-4"><?=$cours["intitule"]?></h2>
		    <?php endif;?>
		<?php endforeach;?>
		<div class="list-group documents">
     	 <?php foreach($documents as $document):?>
              <?php if(isset($_GET['cours']) && $document['cours_id'] == $_GET['cours']): ?>    
                  <list-item lien="<?=$document["path"]?>" titre="<?=$document["nom"]?>" description="" class="ml-4 documents documentsCours<?=$document['cours_id']?>"></list-item>	
              <?php endif;?>
          <?php endforeach;?>
          
          <?php if(isset($_GET['quiz'])): ?>
          <?php 
                echo form_open('/EnseignementsController/checkQuizAnswers'); 
              ?>
              <input type="text" name="quiz_id" value="<?=$_GET['quiz']?>" hidden/>
              <?php foreach($questions as $question):?>
                  <div class="card">
                  	<h4 class="card-title"><?=$question['intitule']?></h4>
                  	<?php $reponses = $this->QuizDAO->getReponsesByQuestionId($question['id']);?>
                  	
              
                      	<?php foreach($reponses as $reponse): ?>
                      		<div class="radio">
                              <label><?=$reponse["contenu"]?>
                              	<input type="radio" name="optradio<?=$question['id'].'-'.$reponse['id']?>">
                              </label>
                            </div>
                      	<?php endforeach;?>
                      	</div>
                      	
              <?php endforeach;?>
              
              	<input type="submit" class="btn btn-primary mt-4 col-md-5 col-sm-2" name="submit_quiz">
              
              <?php 
                echo form_close();
              ?>
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
		</div>
	<?php endif;?>
</div>
</div>

</div>

<script src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>


<?php $this->load->view("page_template/footer");?>
</body>