<?php $this->load->view("page_template/header"); 
?>

<div id="body" class="mbot">
	 

    <card title="<?=($_SESSION['user'] === "admin") ? "Mes classes" : "" ?>">
    	
    	                
        <div class="classesList">
        	<classe-list ref="allClasses"></classe-list>
        </div>
        <?php echo form_open("/ClassesController/createClasse");?>


       

		<?php echo form_close();?>	 
		
    </card>
    <center>
        <h5 class="mt-4">Créer une nouvelle classe</h5>
    	<div class="col-md-4 form-group mb-2" id="formdiv">
              <form-class></form-class>
      		  <br><br>
		</div>
        </center>  
</div>

</div>

<script src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>


<script>



var classeList = Vue.component('classe-list', {
	template: '<div v-if="fetched"><b-container class="bv-example-row"><b-row><b-col><b-list-group v-for="item in classesNames"><b-list-group-item @click="getElevesByClasse(item.id, item.nom)">{{item.nom}}</b-list-group-item></b-list-group></b-col>     <b-col><h3 class="mt-4" v-if="nomClasseClicked && eleves.length > 0">Eleve de la classe {{nomClasseClicked}}</h3> <b-table striped hover :items="eleves" ></b-table><h2 v-if="eleves.length==0 && idClasseClicked!=0 ">Pas encore élèves pour la classe {{nomClasseClicked}}</h2> </b-col></b-row></b-container>  </div>',
	data(){
		return {
			classesNames:[],
			eleves:[],
			nomClasseClicked:"",
			idClasseClicked:0,
			fetched:false
		};
	},
	mounted() {
	  	this.getClasses();
	  	this.$root.$on('refreshClasses', () => {
            this.getClasses();
        });
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
            }catch(err) {
      	        console.log(err);
            }
		},
		async getElevesByClasse(id,classeName) {
			try {
				console.log(id);
				this.nomClasseClicked = classeName;
				this.idClasseClicked = id;
				const students = await axios.get('http://[::1]/projetL3/index.php/api/eleves?classe='+id);
				this.eleves = students.data;
            }catch(err) {
      	        console.log(err);
            }
		}
    }
});

var form = Vue.component ('form-class', {
	template : '<div><label class="required" style="font-weight:bold">Nom de la classe</label><input type="text" v-model="classeNom" name="class_name" class="form-control" placeholder="L3 MIAGE APP"><b-button class="mt-4" @click="createClasse()">Créer la classe</b-button></div>',
	data(){
		return {
			classeNom:"",
		}
	},
	methods: {
		createClasse() {
			console.log("bonjour "+this.classeNom);
			const params = new URLSearchParams();
			params.append('class_name', this.classeNom);
			var that = this;
			
			axios({ method: 'post',
				url: 'http://[::1]/projetL3/index.php/api/create/classe',
				data: params
			}).then(function (response) {
			    // handle success
				that.$root.$emit('refreshClasses');
			  });

			
		}
	}
	
});

</script>


<?php $this->load->view("page_template/footer");?>
</body>
</html>