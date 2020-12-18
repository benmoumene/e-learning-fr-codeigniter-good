var classesList = [];

function getClasses () {
	  const Http = new XMLHttpRequest();
		Http.open("GET", 'http://[::1]/projetL3/index.php/api/classes');
		Http.send();

		Http.onreadystatechange = (e) => {
		  if (Http.readyState === 4) {
			  classesList = JSON.parse(Http.responseText);
			  console.log(classesList);
			  var divList = document.querySelector('.classesList');
			  var ul = document.createElement('ul');
			  
			  classesList.forEach(function(e){
				  console.log(e);
				  var li = document.createElement('li');
				  li.innerText = e['nom'];
				  li.classList = "list-group-item list-group-item-action flex-column align-items-start";
				  
				  ul.appendChild(li);
			  });
			  
			  divList.appendChild(ul);
		  }
		}
}

getClasses();

let listItem = Vue.component('list-item', {
	template: '<a v-bind:href="`${lien}`" class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">{{titre}}</h5></div><p class="mb-1">{{description}}</p></a>',
	props: {
		'lien' : String,
		'titre' : String,
		'description' : String,
	}
});


  

new Vue({el : ".documents", component: listItem});
new Vue({el : ".list-group", component: listItem});
new Vue({el : ".group2", component: listItem});