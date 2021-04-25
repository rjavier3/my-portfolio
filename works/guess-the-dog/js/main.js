let dogImage = document.querySelector('.random-dog-img');
let resetBtn = document.getElementById('reset-btn');
let nextBtn = document.getElementById('next-btn');
let scoreContainer = document.getElementById('score');
let imgContainer = document.querySelector('.img-container');

let randomDogUrl = "https://dog.ceo/api/breeds/image/random";

let answer = '';
let dogBreed = 'pug';
let maxWrong = 5;
let mistakes = 0;
let guessed = [];
let wordStatus = null;
let score = 00;

let menuIcons = document.querySelectorAll('.menu-icon');
let navMenu = document.querySelector('header nav ul');

//navigation for mobile
function toggleNav(event){
	navMenu.classList.toggle('hidden');
	menuIcons[0].classList.toggle('hidden-icon');
	menuIcons[1].classList.toggle('hidden-icon');
}

for(i = 0; i < menuIcons.length; i++) {
	menuIcons[i].addEventListener('click', (event) =>{
		toggleNav();
	});
}

navMenu.addEventListener('click',(event)=>{
	if(event.target.tagName.toLowerCase() === 'a'){
		toggleNav();
	}
	console.log(event.target);
});



function changeDogImage(image_string) {
	dogImage.src = image_string;
}

function generateNewImg(){
	//getting random dog json
	fetch(randomDogUrl, {method: "GET"}).then(response =>{
		// parse the response by extracting the json body
	  	return response.json();
	}).then(json_data => {
		changeDogImage(json_data.message);

		//taking dog breed from json link
		let imageLink = JSON.stringify(json_data.message);
		let imageLinkArray = imageLink.split('/');
		let breedNameWithDash = imageLinkArray[4];
		let breedNameWithoutDash = breedNameWithDash.replace('-', ' ');

		dogBreed = breedNameWithoutDash		
	});
}

//this is the correct answer
function breedName() {
	answer = dogBreed;
}

//this creates the letter buttons
function generateButtons() {
	let buttonsHTML = 'abcdefghijklmnopqrstuvwxyz'.split('').map(letter =>
	  `
		<button
		  class="alphabet-key"
		  id='` + letter + `'
		  onClick="handleGuess('` + letter + `')"
		>
		  ` + letter + `
		</button>
	  `).join('');
  
	document.getElementById('keyboard').innerHTML = buttonsHTML;
  }

//check if letter buttons chosen right or wrong
function handleGuess(chosenLetter) {
	if(chosenLetter !== ' '){
		document.getElementById(chosenLetter).setAttribute('disabled', true);	
	}
	guessed.indexOf(chosenLetter) === -1 ? guessed.push(chosenLetter) : null;

	if (answer.indexOf(chosenLetter) >= 0) {
		guessedWord();
		checkIfGameWon();
		} else if (answer.indexOf(chosenLetter) === -1) {
		mistakes++;
		updateMistakes();
		checkIfGameLost();
	}
}

//if win
function checkIfGameWon() {
	if (wordStatus === answer) {
	document.getElementById('keyboard').innerHTML = 'You Won!';
	score++;
	let scoreWithZeroFront = score.toString().padStart(2, "0");
	scoreContainer.innerText = scoreWithZeroFront;
	nextBtn.classList.remove('hide-btn');
	resetBtn.classList.add('hide-btn');
	}
}

//if lose
function checkIfGameLost() {
	if (mistakes === maxWrong) {
	  document.getElementById('keyboard').innerHTML = 'answer was: ' + answer;
	  document.getElementById('word-spotlight').innerHTML = 'You Lost';
	}
  }

//the blank
function guessedWord() {
	wordStatus = answer.split('').map(letter => (guessed.indexOf(letter) >= 0 ? letter : " _ ")).join('');
	document.getElementById('word-spotlight').innerHTML = wordStatus;
  }

function updateMistakes() {
	document.getElementById('mistakes').innerHTML = mistakes;
}

//////////////////buttons
resetBtn.addEventListener('click', () =>{
	generateNewImg();
	score = 0;
	scoreContainer.innerText = '00';
});

nextBtn.addEventListener('click', () =>{
	generateNewImg();
	nextBtn.classList.add('hide-btn');
	resetBtn.classList.remove('hide-btn');
});

dogImage.onload = function(){
	mistakes = 0;
	guessed = [];
	imgContainer.classList.add('zoom');

	breedName();
	guessedWord();
	updateMistakes();
	generateButtons();
	fillSpace();
}


document.getElementById('max-wrong').innerHTML = maxWrong;
breedName();
generateButtons();
guessedWord();

//fill space
function fillSpace(){
	if(answer.split('').includes(' ')){
		handleGuess(' ');
	}
}
fillSpace();

imgContainer.addEventListener('click', ()=>{
	imgContainer.classList.toggle('zoom');
});