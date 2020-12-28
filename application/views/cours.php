<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$coursSelectionne = null;
if (isset($_GET['cours'])) {
    $coursSelectionne = $this->CoursDAO->getCoursById($_GET['cours']);
    $classbycours = array();

        $res = $this->ClasseDAO->getClasseForCoursId($coursSelectionne['id']);
        if (!empty($res)) {
            $classeinfo = array();
            foreach ($res as $r) {
                array_push($classeinfo, $this->ClasseDAO->getClasseById($r["classe_id"]));
            }
            array_push($classbycours, $classeinfo);
        }
}
?>
<!-- AFFICHER LE MENU -->
<?php $this->load->view("page_template/header"); ?>

<center>
<div id="body" class="d-flex mt-2 mb-4 row">
	<card class="cours"
		title="<?=($_SESSION["user"] === "admin") ? "Les cours de l'enseignante" : "Mes cours" ?>">
		
		<b-list-group>
    		<div class="list-group mb-2">
    			<?php if($_SESSION['user'] === 'admin'): ?>
    				<b-list-group-item href="/projetL3/index.php/cours">Créer un cours</b-list-group-item>
    			<?php endif;?>
    			
                <?php foreach ($coursList as $cours): ?>
                	<b-list-group-item href="/projetL3/index.php/cours?cours=<?=$cours['id']?>"><?=$cours['intitule']?></b-list-group-item>
    			<?php endforeach;?>
    		</div>
		</b-list-group>
	</card>

    <card class = "cours btn-creercours" title="<?=(empty($_GET['cours']) && $_SESSION['user'] === 'admin') ? 'Créer un cours' : '' ?>">
	<div class="justify-content-md-center" >
        <?php if(empty($_GET["cours"]) && $_SESSION['user'] === 'admin'): ?>
		<?=form_open_multipart('/CoursController/creer_cours');?>

        <div class="row">
            <div class="col-md-6 form-group mb-2">
                <label class="required" style="font-weight:bold">Nom du cours</label>
                <input class="form-control" type="text" id="nom_cours" name="nom_cours" placeholder="Nom du cours"/><br><br>
            </div>
            <div class="col-md-6 form-group mb-2">
                <label for="exampleFormControlTextarea1" style="font-weight:bold">Description du cours</label>
                <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="5" name="description"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-2">
                <label style="font-weight:bold" class="required">Documents du cours</label>
                <input type="file"  class="form-control" id="id" name="files[]" multiple="multiple"/><br>
            </div>

            <div class="col-md-6 form-group mb-2">
                <label class="required" style="font-weight:bold">Classes</label><br>
                <select class="form-control" name="classes_ids[]" multiple="multiple">
                    <?php foreach($classeList as $classe): ?>
                        <option value="<?=$classe['id']?>"><?=$classe['nom']?></option>
                    <?php endforeach;?>
                </select><br><br>
            </div>
        </div>


        	<input class="btn btn-primary" type="submit" name="creer" value="Créer" /><br><br>

		<?php echo form_close();?>	
		<?php endif;?>
        
        	
        	
        	<?php if(!empty($coursSelectionne)): ?>
			<p><?=$coursSelectionne['description']?></p>
			
    			<div class="documentsList mb-4">
    				<?php if($_SESSION['user'] === 'admin'): ?>
    					<add-document></add-document>
    				<?php endif;?>
    				<documents-list></documents-list>
				</div>
				<hr>

		<?php if($_SESSION['user'] === 'admin'): ?>
    			<?=form_open_multipart('/CoursController/modifyClasses');?>
    				<input type="text" name="cours_id" value="<?=$_GET['cours']?>" hidden/>
    				
    				<div class="classesList">
    					<classes-cours></classes-cours>
    				</div>

                    <label style="font-weight:bold">Mettre en ligne dans une classe</label><br>

                    <select class="form-control" name="classes_ids[]" multiple="multiple">
                        <?php foreach($classeList as $classe): ?>
                            <option value="<?=$classe['id']?>"><?=$classe['nom']?></option>
                        <?php endforeach;?>
                    </select><br>
                    <input class="btn btn-primary" type="submit" name="modifyClasses" value="Modifier les classes" />
    			<?php echo form_close();?>
			<?php endif;?>
			
			
			
		<?php endif;?>

        <div class="documents mbot">
        	<?php if($_SESSION['user'] === 'admin' && isset($_GET['cours'])): ?>
                <?php echo form_open('/CoursController/removeCours');?>
                    <input type="text" value="<?=$_GET['cours']?>" name="cours_id" hidden/>
                    <hr>
                    <button class="mt-4 btn btn-danger deleteCours" title="Supprimer le cours" onclick="return confirm('Etes vous sur de vouloir supprimer ce cours?')">Supprimer le cours <i class="fa fa-trash" style="font-size:30px;"></i></button>
                <?php echo form_close();?>
            <?php endif;?>

        </div>
	</div>
    
	</card>
</div>
</center>


<?php $this->load->view("page_template/footer");?>
<script>
Vue.use(VueToast);
if(("<?=$this->session->flashdata('import')?>".includes("Le cours a été crée avec ") && "<?=$this->session->flashdata('import')?>".includes(" documents associés"))){
	Vue.$toast.success("<?=$this->session->flashdata('import');?>", {
	  position: 'top',
	  duration: 8000
	})
}	
else if("<?=$this->session->flashdata('cours_champ_required')?>" === "Veuillez saisir les champs requis"){
	Vue.$toast.error("<?=$this->session->flashdata('cours_champ_required');?>", {
		  position: 'top', 
		  duration: 8000
		})
}
else if("<?=$this->session->flashdata('import')?>" === "Les documents doivent être de type pdf"){
    Vue.$toast.error("<?=$this->session->flashdata('import');?>", {
	  position: 'top', 
	  duration: 8000
	})
} 

</script>

<script>
var documentsList = Vue.component('documents-list', {
	template: '<div :key="fetched"><h4>Documents du cours</h4><b-container class="bv-example-row" v-for="(document, index) in documents" :key="document.id"><b-row><b-col><b-list-group-item class="ml-4" style="width:300px" target="_blank" :href="document.path">{{document.nom}} </b-list-group-item></b-col><b-col><b-button @click="deleteDocument(index)">supprimer</b-button></b-col></b-row><b-container></div>',
	data(){
		return {
			documents:[],
			fetched:0
		};
	},
	mounted() {
	  	this.getDocumentsByCours();
	  	this.$root.$on('refreshDocuments', () => {
            this.getDocumentsByCours();
        });
	},
	methods:  {
		async getDocumentsByCours() {
			let urlParams = new URLSearchParams(window.location.search);
			let coursParam = urlParams.get('cours');
			try {
				const docs = await axios.get('http://[::1]/projetL3/index.php/api/documents?cours_id='+coursParam);
				this.documents = docs.data;
				console.log(this.documents);
				this.fetched = this.fetched+1;
            }catch(err) {
      	        console.log(err);
            }
		},
		deleteDocument(index) {
			console.log('supprimer le doc : '+JSON.stringify(this.documents[index]));
			const params = new URLSearchParams();
			params.append('document_id', this.documents[index].id);
			var that = this;
			
			axios({ method: 'post',
				url: 'http://[::1]/projetL3/index.php/api/delete/document',
				data: params
			}).then(function (response) {
			    // handle success
				that.$root.$emit('refreshDocuments');
			  });
		}
	}
});

var addDocumentsComponent = Vue.component('add-document', {
	template: '<div><label style="font-weight:bold">Ajouter des documents</label><input type="file" ref="files" class="form-control" id="id" multiple="multiple" v-on:change="handleFilesUpload()"/><b-button type="submit" class="mt-2 mb-4" @click="addDocuments">Ajouter le document</b-button></div>',
	data(){
		return {
			files:''
		};
	},
	methods:  {
        handleFilesUpload(){
            this.files = this.$refs.files.files;
        },
		addDocuments() {
        	 let urlParams = new URLSearchParams(window.location.search);
			 let coursParam = urlParams.get('cours');
        	 let formData = new FormData();
			 var that = this;
        	 
        	 formData.append('cours_id', coursParam);
        	 for( var i = 0; i < this.files.length; i++ ){
    		    let file = this.files[i];
				formData.append('files[' + i + ']', file);
    		 }

             axios.post( 'http://[::1]/projetL3/index.php/api/add/document',
                     formData,
                     {
                     headers: {
                         'Content-Type': 'multipart/form-data'
                     }
                   }
                 ).then(function(response){
                	 that.$root.$emit('refreshDocuments');
            	 });
		}
	}
});


var classesList = Vue.component('classes-cours', {
	template: '<div :key="fetched"><label style="font-weight:bold">Classes liées au cours</label><br><b-list-group horizontal class="mb-4"><b-list-group-item v-for="classe in classes">{{classe.nom}}</b-list-group-item></b-list-group><p v-if="fetched > 0 && classes.length == 0" style="color:red" class="mb-4">Pas encore de classes associés à ce cours</p></div>',
	data(){
		return {
			classes:[],
			fetched:0
		};
	},
	mounted() {
	  	this.getClassesByCours();
	  	this.$root.$on('refreshClasses', () => {
            this.getClassesByCours();
        });
	},
	methods:  {
		async getClassesByCours() {
			let urlParams = new URLSearchParams(window.location.search);
			let coursParam = urlParams.get('cours');
			try {
				const clas = await axios.get('http://[::1]/projetL3/index.php/api/cours/classes?cours_id='+coursParam);
				this.classes = clas.data;
				this.fetched = this.fetched+1;
            }catch(err) {
      	        console.log(err);
            }
		}
	}
});

new Vue({el : ".documentsList", components: {documentsList, addDocumentsComponent } });
new Vue({el : ".classesList", components: {classesList } });


</script>

</body>
</html>