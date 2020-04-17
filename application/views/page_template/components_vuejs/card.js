let card = Vue.component('card', {
	template: '<div class="card"><div class="card-body"><h2 class="card-title mb-4" v-if="title != ``">{{title}}</h2><slot></slot></div></div>',
	props:{
		title: String
	}
});

new Vue({el : ".d-flex", component: card});
new Vue({el : "#body", component: card});