let item = Vue.component('menu-item', {
			template: '<li class="nav-item"><a class="nav-link" style="color: black" v-if="nom !== `compte` && nom !== `connexion` && nom !== `deconnexion`" v-bind:href="`/projetL3/index.php/${nom}`">{{nom}}</a> <a class="nav-link" style="color: black" v-else-if="nom === `connexion`" v-bind:href="`/projetL3/index.php/${nom}`" ><i class="nav-item fa fa-sign-in" style="font-size: 34px"></i></a> <a class="nav-link" style="color: black" v-else-if="nom === `deconnexion`" v-bind:href="`/projetL3/index.php/${nom}`" ><i class="nav-item fa fa-sign-out" style="font-size: 34px; color:black;"></i></a> <a class="nav-link" style="color:black;"v-bind:href="`/projetL3/index.php/${nom}`" v-else><i class="nav-item fa fa-user-circle-o" style="font-size: 34px; color:black;"></i></a></li>',
	props: {
		'nom' : String
	}
});



new Vue({el : ".navbar-nav", components: item});

let menu = Vue.component('menu',{
	template: `<slot></slot>`
				
});
new Vue({el : ".navbar", components: menu});
