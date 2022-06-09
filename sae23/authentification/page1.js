//script

function creationbouton() {
  var btn =  document.createElement('button'); //créer le bouton
  vart input = document.getElementById('newevent');//récupérer l'input
  btn.setAttribute('name', input .value); //lui donner son nom
  input.parentNode.insertBefore(btn, input.nextSibling);//l'insérer dans le dom où on veut: ici après l'input 
  //(insérer parmi les fils du parent de l'input, avant le suivant de l'input)
}

function add_alert() {
    console.log("alert add")
}

