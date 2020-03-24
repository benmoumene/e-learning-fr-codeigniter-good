Vue.component('menu-item', {
	template: '<li class="nav-item"><a class="nav-link" style="text-transform: uppercase"  v-if="nom !== `compte`" v-bind:href="`/projetL3/index.php/${nom}`">{{nom}}</a> <a class="nav-link" v-bind:href="`/projetL3/index.php/${nom}`" v-else><i class="nav-item fa fa-user-circle-o" style="font-size: 34px"></i></a></li>',
	props: {
		'nom' : String
	}
})

new Vue({el : ".nav"})
