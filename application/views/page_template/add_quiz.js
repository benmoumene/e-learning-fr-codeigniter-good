
var cptQuestion = 1;
    //button to add an answer
	const boutonAddReponse = document.querySelector('.addReponse');
	boutonAddReponse.addEventListener('click', ajoutReponse);
	
	//button to add question
	const boutonAddQuestion = document.querySelector('.addQuestion');
	boutonAddQuestion.addEventListener('click', ajoutQuestion);
	
	//button to remove an answer
	const boutonRemoveReponse = document.querySelector('.removeReponse');
	boutonRemoveReponse.addEventListener('click', removeReponse);
	
	//button to add i questions 
	const boutonNombreQuestion = document.querySelector('.nombreQuestions');
	boutonNombreQuestion.addEventListener('click', function(e){
		e.preventDefault();
		console.log(e.target);
		const numberOfQuestionsToAdd = e.target.previousElementSibling.value;
		console.log(numberOfQuestionsToAdd);
		for(let $i = 0; $i < numberOfQuestionsToAdd; $i++){
			boutonAddQuestion.click();
		}
	});
	
	//button to remove last question
	const boutonRemoveQuestion = document.querySelector('.removeQuestion');
	boutonRemoveQuestion.addEventListener('click', function(e){
		e.preventDefault();
		const self = e.target;
		//getting removeReponse button
		const removeReponseButton = self.previousElementSibling.previousElementSibling.previousElementSibling;
		console.log(removeReponseButton);
		
		let elementsRemove = removeReponseButton.classList[5].split("-");
		const questionNumber = Number(elementsRemove[1]);
		const reponseNumber = Number(elementsRemove[2]);
		
		if(questionNumber > 1){
			const input = document.getElementsByName('question '+questionNumber)[0];
			const label = input.previousElementSibling;
			
			document.querySelector('.addQuestion').classList.remove("addQuestion-"+questionNumber);
			self.classList.remove('removeQuestion-'+questionNumber);
			document.querySelector('.addQuestion').classList.add("addQuestion-"+(questionNumber-1));
			self.classList.add('removeQuestion-'+(questionNumber-1));
			
			//removing answers of the question
			for(let i=1; i <= reponseNumber; i++){
				removeReponseButton.click();
			}
			
			//remove input of the question
			input.parentNode.removeChild(input);
			label.parentNode.removeChild(label);
			
			//we delete the buttons add and remove reponse
			const ajoutReponse = self.previousElementSibling.previousElementSibling.previousElementSibling;
			
			ajoutReponse.previousSibling.previousSibling.previousSibling.parentNode.removeChild(ajoutReponse.previousSibling.previousSibling.previousSibling);
			
			ajoutReponse.previousSibling.previousSibling.parentNode.removeChild(ajoutReponse.previousSibling.previousSibling);
			ajoutReponse.previousSibling.parentNode.removeChild(ajoutReponse.previousSibling);
			
			ajoutReponse.parentNode.removeChild(ajoutReponse);
			
			const addQuestion = document.querySelector('.addQuestion');
			addQuestion.previousElementSibling.parentNode.removeChild(addQuestion.previousElementSibling);
				
		}
	});
	
	
	function ajoutQuestion(e){
		e.preventDefault();
		const cptReponse = Number(0);
		const removeQuestionButton = document.querySelector('.removeQuestion');
		
		cptQuestion = Number(e.target.classList[6].split("-")[1]);
		e.target.classList.remove("addQuestion-"+cptQuestion);
		removeQuestionButton.classList.remove('removeQuestion-'+cptQuestion);
		e.target.classList.add("addQuestion-"+(cptQuestion+1));
		removeQuestionButton.classList.add('removeQuestion-'+(cptQuestion+1));
		
		
		
		/*On cree les elements necessaires à l'ajout d'une question*/
		let labelQuestion = document.createElement("label");
		labelQuestion.classList = "required font-weight-bold";
		labelQuestion.innerHTML = "Question "+(++cptQuestion);

		let inputTextQuestion = document.createElement("input");
		inputTextQuestion.type = "text";
		inputTextQuestion.name = "question "+cptQuestion;
		inputTextQuestion.classList = "questionInput";

		let addReponse = document.createElement("button");
		addReponse.classList = "btn btn-primary ml-2 col-md-1 col-sm-2 addReponse addReponse-"+cptQuestion+"-"+cptReponse;
		addReponse.innerHTML = "<i class='fa fa-plus-circle' onclick='this.parentNode.click()'></i>";
		addReponse.style.marginRight = "5px";
		
		let removeButton = document.createElement("button");
		removeButton.classList = "btn btn-danger col-md-1 col-sm-2 removeReponse removeReponse-"+cptQuestion+"-"+cptReponse;
		removeButton.innerHTML = "<i class='fa fa-minus-circle' onclick='this.parentNode.click()'></i>";
		
		addReponse.addEventListener('click', ajoutReponse);
		removeButton.addEventListener('click', removeReponse);
		
		//ajout de la question
		const addQuestion = document.querySelector('.documents').children[0];
		addQuestion.insertBefore(document.createElement("br"), this);
		addQuestion.insertBefore(labelQuestion, this);
		addQuestion.insertBefore(inputTextQuestion, this);
		addQuestion.insertBefore(document.createElement("br"), this);
		addQuestion.insertBefore(addReponse, this);
		addQuestion.insertBefore(removeButton, this);
		addQuestion.insertBefore(document.createElement("br"), this);
	
		//on ajoute 2 reponse a la nouvelle question
		addReponse.click();
		addReponse.click();
	}
	
	function ajoutReponse(e){
		e.preventDefault();
		
		let reponseButton = e.target; 
		const reponseElement = reponseButton.classList[6].split("-");
		
		cptQuestion = reponseElement[1];
		const cptReponse = Number(reponseElement[2])+1;
		let removeReponse = document.querySelector(".removeReponse-"+cptQuestion+"-"+reponseElement[2]);
		
		reponseButton.classList.remove("addReponse-"+cptQuestion+"-"+(cptReponse-1));
		reponseButton.classList.add("addReponse-"+cptQuestion+"-"+cptReponse);
		removeReponse.classList.remove("removeReponse-"+cptQuestion+"-"+(cptReponse-1));
		removeReponse.classList.add("removeReponse-"+cptQuestion+"-"+cptReponse);
		
		/*On cree les elements necessaires à l'ajout d'une reponse*/
		let labelReponse = document.createElement("label");
		labelReponse.classList = "required labelreponse-"+cptQuestion+"-"+cptReponse;
		labelReponse.innerHTML = "Reponse "+cptReponse;

		let labelVrai = document.createElement("label");
		labelVrai.innerHTML = "Vrai ?";
		labelVrai.classList="labelcheckbox-"+cptQuestion+"-"+cptReponse;
		
		let inputTextReponse = document.createElement("input");
		inputTextReponse.type = "text";
		inputTextReponse.name = "reponse-"+cptQuestion+"-"+(cptReponse);

		let inputCheckbox = document.createElement("input");
		inputCheckbox.type = "checkbox";
		inputCheckbox.name = "estvrai-"+cptQuestion+"-"+cptReponse;		

		//on ajoute les elements pour une nouvelle reponse
		const newReponse = document.querySelector('.documents').children[0];
		newReponse.insertBefore(document.createElement("br"), this);
		newReponse.insertBefore(labelReponse, this);		
		newReponse.insertBefore(inputTextReponse, this);
		newReponse.insertBefore(labelVrai, this);
		newReponse.insertBefore(inputCheckbox, this);
	}
	
	function removeReponse(e){
		e.preventDefault();
		
		let elementsRemove = e.target.classList[5].split("-");
		const reponseNumber = Number(elementsRemove[2])-1;
		let boutonAdd = document.querySelector(".addReponse-"+elementsRemove[1]+"-"+elementsRemove[2]);
		
		const labelReponse = document.querySelector(".labelreponse-"+elementsRemove[1]+"-"+elementsRemove[2]);
		const respInput = document.getElementsByName("reponse-"+elementsRemove[1]+"-"+elementsRemove[2])[0];
		const labelCheckbox = document.querySelector(".labelcheckbox-"+elementsRemove[1]+"-"+elementsRemove[2]);
		const checkbox = document.getElementsByName("estvrai-"+elementsRemove[1]+"-"+elementsRemove[2])[0];
		
		e.target.classList.remove(elementsRemove[0]+"-"+elementsRemove[1]+"-"+(reponseNumber+1));
		e.target.classList.add(elementsRemove[0]+"-"+elementsRemove[1]+"-"+reponseNumber);
		boutonAdd.classList.remove("addReponse-"+elementsRemove[1]+"-"+elementsRemove[2]);
		boutonAdd.classList.add("addReponse-"+elementsRemove[1]+"-"+reponseNumber);
		
		//we remove elements that are part of the answer
		removeElement(labelReponse.previousElementSibling);
		removeElement(labelReponse);
		removeElement(respInput);
		removeElement(labelCheckbox);
		removeElement(checkbox);
	}
	
	function removeElement(element){
		element.parentNode.removeChild(element);
	}
