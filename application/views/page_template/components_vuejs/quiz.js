let listItem = Vue.component('list-item', {
	template: '<a v-bind:href="`${lien}`" class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">{{titre}}</h5></div><p class="mb-1">{{description}}</p></a>',
	props: {
		'lien' : String,
		'titre' : String,
		'description' : String,
	}
});
let card = Vue.component('card', {
	template: '<div class="card"><div class="card-body"><h2 class="card-title mb-4" v-if="title != ``">{{title}}</h2><slot></slot></div></div>',
	props:{
		title: String
	}
});


var quizVue = new Vue({el : ".d-flex",
	component: card,
	data() {
		return { questions: [ { numeroQuestion : 1, numeroReponse : 2 },
			      			  { numeroQuestion: 2, numeroReponse : 3 } 
			                ],
			     nombreQuestion : 2, 
			     nbQuestionSouhaite : 0
			   }
	},
	methods: {
		addQuestion: function (event) {
		  this.nombreQuestion = Number(this.nombreQuestion)+1;
		  
		  this.questions.push({numeroQuestion : this.nombreQuestion, numeroReponse : 2 });
		  
		},
		removeQuestion: function (event) {
		  const question = Number(event.target.name)-1;
		  Vue.delete(this.questions, question);
		  //refreshing questions
		  let indexQuestion = 1;
		  for(let i=0; i < this.questions.length; i++) {
		  	this.questions[i].numeroQuestion = indexQuestion;
		  	indexQuestion += 1;
		  }
		  this.nombreQuestion = this.questions.length;
		  
		},
		addReponse: function (event) {
			const question = Number(event.target.name)-1;
			this.questions[question].numeroReponse+=1; 
		},
		removeReponse: function (event) {
			const question = Number(event.target.name)-1;
			this.questions[question].numeroReponse-=1;

		},
		addMultipleQuestions : function(event) {
			if(this.nbQuestionSouhaite > 0){
				const nombre = Number(this.nbQuestionSouhaite);
				for(let i=1; i <= nombre; i++){
					this.addQuestion(event);
				}
				this.nombreQuestion = this.questions.length;
			}
		}
  	}
});

new Vue({el : ".list-group",
	component: card});