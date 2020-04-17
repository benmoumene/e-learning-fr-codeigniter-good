/* variable qui vont nous servir a distinguer les different input pour les question 
	et reponses */
	var cptReponse = 3;
    var cptQuestion = 1;

    //on ecoute le click du bouton 'ajouter une reponse'
	var boutonReponse = document.querySelector('.addReponse');
	boutonReponse.addEventListener('click', ajoutReponse);

	//on ecoute le click du bouton 'ajouter une question'
	var boutonQuestion = document.querySelector('.addQuestion');
	boutonQuestion.addEventListener('click', ajoutQuestion);

	function ajoutQuestion(e){
		e.preventDefault();
		cptReponse = 1;
		cptQuestion++;
		/*On cree les elements necessaires à l'ajout d'une question*/
		let labelQuestion = document.createElement("label");
		labelQuestion.classList = "required";
		labelQuestion.innerHTML = "Question "+cptQuestion;

		let inputTextQuestion = document.createElement("input");
		inputTextQuestion.type = "text";
		inputTextQuestion.name = "question_"+cptQuestion;
		inputTextQuestion.classList = "questionInput";

		let br = document.createElement("br");
		
		let documents = document.querySelector('.documents');
		documents.children[0].insertBefore(br, boutonReponse);
		documents.children[0].insertBefore(labelQuestion, boutonReponse);
		documents.children[0].insertBefore(inputTextQuestion, boutonReponse);
		documents.children[0].insertBefore(br, boutonReponse);

	}
	
	function ajoutReponse(e){
		e.preventDefault();

		/*On cree les elements necessaires à l'ajout d'une reponse*/
		let labelReponse = document.createElement("label");
		labelReponse.classList = "required";
		labelReponse.innerHTML = "Reponse "+cptReponse;

		let labelVrai = document.createElement("label");
		labelVrai.innerHTML = "Vrai ?";
		
		let inputTextReponse = document.createElement("input");
		inputTextReponse.type = "text";
		inputTextReponse.name = "reponse-"+cptQuestion+"-"+(cptReponse);

		let inputCheckbox = document.createElement("input");
		inputCheckbox.type = "checkbox";
		inputCheckbox.name = "estvrai-"+cptQuestion+"-"+(cptReponse++);		
		
		let br = document.createElement("br");

		//on ajoute les elements pour une nouvelle reponse
		let documents = document.querySelector('.documents');
		documents.children[0].insertBefore(labelReponse, this);		
		documents.children[0].insertBefore(inputTextReponse, this);
		documents.children[0].insertBefore(labelVrai, this);
		documents.children[0].insertBefore(inputCheckbox, this);
		documents.children[0].insertBefore(br, this);
	}
