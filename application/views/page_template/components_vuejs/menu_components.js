let item = Vue.component('menu-item', {
	template: '<li class="nav-item"><a class="nav-link" style="text-transform: uppercase"  v-if="nom !== `compte` && nom !== `connexion` && nom !== `deconnexion`" v-bind:href="`/projetL3/index.php/${nom}`">{{nom}}</a> <a class="nav-link" v-else-if="nom === `connexion`" v-bind:href="`/projetL3/index.php/${nom}`" ><i class="nav-item fa fa-sign-in" style="font-size: 34px"></i></a> <a class="nav-link" v-else-if="nom === `deconnexion`" v-bind:href="`/projetL3/index.php/${nom}`" ><i class="nav-item fa fa-sign-out" style="font-size: 34px"></i></a> <a class="nav-link" v-bind:href="`/projetL3/index.php/${nom}`" v-else><i class="nav-item fa fa-user-circle-o" style="font-size: 34px"></i></a></li>',
	props: {
		'nom' : String
	}
});



new Vue({el : ".navbar-nav", components: item});

let menu = Vue.component('menu',{
	template: `
	<div class="container">
    <div class="row" style="width: 100%;">
    <div class="col-12">
        <div class="row">
          <div class="col-2">
            <a class="navbar-brand" href="/projetL3/index.php/"><div id="logo-site"></div></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          </div>
        <div class="col-10" id="account">
            <div class="col-12">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav" style="width: 100%;">	
					<slot></slot>
				</ul>
              </div>
            </div>
        </div>
      </div>
    </div>
    </div></div></div>
`
});
new Vue({el : ".navbar", components: menu});
