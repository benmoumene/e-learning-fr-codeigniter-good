<?php $this->load->view("page_template/header"); 
	  echo form_open_multipart('/AccesController/import');
?>

<div id="body">
    <center>
	<card class="connexion mbot" title="Création des comptes pour les étudiants" >
		<div class="justify-content-md-center">
            <div class="col-md-4 form-group mb-2">
            	<label class="required" style="font-weight:bold">Classe</label>
            		<classes-options></classes-options>
            	<br>
            	
            	<label class="required" style="font-weight:bold">Fichier d'importation</label>
            	<input type="file" class="form-control" id="id" name="file" /><br><br>
               	
                <input class="btn btn-primary" type="submit" name="import" value="Importer" /><br><br>
			</div>
		</div>
            <p>Utilisez le fichier ci-dessous comme format pour importer les étudiants lors de la création d'une classe.</p>
            <a id="fichierImportation" href="/projetL3/uploads/modele_insertion/modele_importation.xlsx">
                <img height="100" alt="fichier d'importation" src="/projetL3/application/views/images/excel.jpg"/>
            </a>
    </card>
    </center>
</div>
	
<?php
echo form_close();
?>

<script>
var classesOptions = Vue.component('classes-options', {
	template: '<div v-if="fetched"><select name="classe_id"><option v-for="classe in classesNames" :value="classe.id">{{classe.nom}}</option></select> </div>',
	data(){
		return {
			classesNames:[],
			fetched:false
		};
	},
	mounted() {
	  	this.getClasses();
	},
	beforeDestroy() {
	  	clearInterval(this.setIntervalId);
	},
	methods:  {
		async getClasses() {
			try {
				const classes = await axios.get('http://[::1]/projetL3/index.php/api/classes');
				this.classesNames = classes.data;
				this.fetched = true;
				console.log(this.classesNames);
            }catch(err) {
      	        console.log(err);
            }
		}
    }
});
</script>

<?php $this->load->view("page_template/footer");?> 


    
</body>
</html>

