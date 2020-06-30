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

$coursSelectionne = null;
if (isset($_GET['cours'])) {
    $coursSelectionne = $this->CoursDAO->getCoursById($_GET['cours']);
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

<div class="d-flex mt-2 mb-4 row">
        <card  class = "cours"
            title="<?=($_SESSION["user"] === "admin") ? "Les cours de l'enseignante" : "Mes cours" ?>">
            <div class="list-group mb-2">
                      <?php foreach ($coursList as $cours): ?>
                <list-item
                    lien="/projetL3/index.php/enseignements?cours=<?=$cours['id']?>"
                    titre="<?=$cours['intitule']?>" description="Description du cours"
                    class="coursIntitule">
                </list-item>
                    <?php endforeach;?>
            </div>
        </card>

        <card class=" cours p-2 mr-4 w-50" title="<?=$title?>">
        <div class="list-group documents">
            <?php if(!empty($coursSelectionne)): ?>
                <p><?=$coursSelectionne['description']?></p>
                <hr>
                <h4>Documents du cours</h4>
            <?php endif;?>

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
                    if ($_SESSION['user'] === 'admin') {
                        echo form_open('/EnseignementsController/saveNewQuiz');
                    } else {
                        echo form_open('/EnseignementsController/checkQuizAnswers');
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
            <label class="required">Question 1</label> <input type="text"
                name="question 1" class="questionInput"><br>
            <br> <label class="required">Reponse 1</label> <input type="text"
                name="reponse-1-1"> <label>Vrai ?</label> <input type="checkbox"
                name="estvrai-1-1" /><br> <label class="required">Reponse 2</label> <input
                type="text" name="reponse-1-2"> <label>Vrai ?</label> <input
                type="checkbox" name="estvrai-1-2" /><br>

            <button class="btn btn-primary mt-4 col-md-5 col-sm-2 addReponse">Ajouter
                une reponse</button>
            <button class="btn btn-primary mt-4 col-md-5 col-sm-2 addQuestion">Ajouter
                une question</button>
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

        <card class=" p-2 ml-auto " title="<?=($_SESSION["user"] === "admin") ? "Mes quiz" : "Liste des quiz" ?>">
            <?php if(sizeof($quizzes) === 0): ?>
                <p>Pas encore de quiz diponible</p>
                <?php else: ?>
                <div class="list-group group2">
                <?php foreach ($quizzes as $quiz): ?>
                          <list-item
                            lien="/projetL3/index.php/enseignements?quiz=<?=$quiz['id']?>&quiz_name=<?=$quiz['nom']?>"
                            titre="<?=$quiz['nom']?>" description="Description du cours"></list-item>
                <?php endforeach;?>
                <?php if($_SESSION['user'] === 'admin'): ?>
                        <list-item lien="/projetL3/index.php/enseignements?quiz=add"
                            titre="+" description=""></list-item>
                <?php endif;?>
                </div>
            <?php endif;?>
        </card>
    </div>


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

