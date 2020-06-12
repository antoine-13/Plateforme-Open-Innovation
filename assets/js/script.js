/* Ecran de chargement des pages */
var myVar;
function loadFunction() {
  myVar = setTimeout(showPage, 1000);
}
function showPage() {
  document.getElementById("loader-wrapper").style.display = "none";
  document.querySelector("main").style.display = "block";
}

/* Graphiques avec chart.js*/
var ctx_1 = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx_1, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Nombre d\'inscrit',
            backgroundColor: 'transparent',
            borderColor: 'rgb(178, 181, 243)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {}
});
var ctx_2 = document.getElementById('myChart_2').getContext('2d');
var myDoughnutChart = new Chart(ctx_2, {
  type: 'doughnut',
  data: {
    labels: ['B1', 'B2', 'B3', 'M1', 'M2'],
    datasets: [{
      label: '% per years',
      data: [50, 20, 15, 10, 5],
      backgroundColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgb(178, 181, 243)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgb(178, 181, 243)'
      ],
      borderWidth: 1
    }]
  },
  options: {
   	//cutoutPercentage: 40,
    responsive: false,

  }
});

/* Annimation lors du scroll avec l'extension skrollr.js */
window.addEventListener('scroll', function(){
  var nav = document.querySelector('.container-nav');
  nav.classList.toggle("active" , window.scrollY > 200);
})

window.addEventListener('scroll', function(){
    var scroll = document.querySelector('.gotop');
    scroll.classList.toggle("active" , window.scrollY > 500);
})
window.addEventListener('scroll', function(){
  var scroll = document.querySelector('.partie_1 h2');
  scroll.classList.toggle("active" , window.scrollY > 200);
})

window.addEventListener('scroll', function(){
  var scroll = document.querySelector('.pres .text_img:nth-child(1) h2');
  scroll.classList.toggle("active" , window.scrollY > 1000);
})
window.addEventListener('scroll', function(){
  var scroll = document.querySelector('.pres .text_img:nth-child(2) h2');
  scroll.classList.toggle("active" , window.scrollY > 800);
})

/* Boutton pour retourner en haut de la page d'accueil des élèves */
function gotop(){
    window.scrollTo({
        top: 0
    })
}

/* Fonction "se rappeller de moi" sur la page de connexion */
const rmCheck = document.getElementById("rememberMe"),
    emailInput = document.getElementById("username");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheck.setAttribute("checked", "checked");
  emailInput.value = localStorage.username;
} else {
  rmCheck.removeAttribute("checked");
  emailInput.value = "";
}

function lsRememberMe() {
  if (rmCheck.checked && emailInput.value !== "") {
    localStorage.username = emailInput.value;
    localStorage.checkbox = rmCheck.value;
  } else {
    localStorage.username = "";
    localStorage.checkbox = "";
  }
}


/* Apparition des formulaires pour les rendus et l'inscription*/
function new_rendu_professeur(){
  document.querySelector(".form_new_rendu").classList.add("active");
}
function new_rendu_etudiant(){
  document.querySelector(".form_new_rendu_etudiant").classList.add("active");
}
function inscription(){
  document.querySelector(".form-inscription").classList.add("active");
}



