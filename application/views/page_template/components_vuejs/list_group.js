let listItem = Vue.component('list-item', {
	template: '<a v-bind:href="`${lien}`" target="_blank" class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">{{titre}}</h5></div><p class="mb-1">{{description}}</p></a>',
	props: {
		'lien' : String,
		'titre' : String,
		'description' : String,
	}
});

new Vue({el : ".documents", component: listItem});
new Vue({el : ".list-group", component: listItem});
new Vue({el : ".group2", component: listItem});