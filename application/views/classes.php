<?php $this->load->view("page_template/header"); 
?>

<div id="body" class="mbot">
    <card title="<?=($_SESSION['user'] === "admin") ? "Mes classes" : "" ?>">
    	
    	                
        <div class="classesList">
        	<classe-list></classe-list>
        </div>
        <?php echo form_open("/ClassesController/createClasse");?>


        <center>
        <h5 class="mt-4">Créer une nouvelle classe</h5>
    	<div class="col-md-4 form-group mb-2">
              <label class="required" style="font-weight:bold">Nom de la classe</label>
              <input type="text" name="class_name" class="form-control" placeholder="L3 MIAGE APP">
      		  <input class="btn btn-primary mt-2" type="submit" value="Créer" /><br><br>
		</div>
        </center>

		<?php echo form_close();?>	   
    </card>
</div>

</div>

<script src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>

<script>
var classeList = Vue.component('classe-list', {
	template: '<div v-if="fetched"><div v-for="item in classesNames"><list-item :titre="item.nom" :lien="`classes/eleves?id=${item.id}`"></list-item></div></div>',
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
            }catch(err) {
      	        console.log(err);
            }
		}
    },
	component: listItem
});
</script>

<?php $this->load->view("page_template/footer");?>
</body>
</html>