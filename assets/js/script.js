var myVar;


function loadFunction() {
  myVar = setTimeout(showPage, 1000);
}

function showPage() {
  document.getElementById("loader-wrapper").style.display = "none";
  document.querySelector("main").style.display = "block";
}

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
  scroll.classList.toggle("active" , window.scrollY > 1200);
})
window.addEventListener('scroll', function(){
  var scroll = document.querySelector('.pres .text_img:nth-child(2) h2');
  scroll.classList.toggle("active" , window.scrollY > 800);
})


function gotop(){
    window.scrollTo({
        top: 0
    })
}

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




function swipe(id){
  if(id == "right"){
    document.querySelector(".tab-info-groups").id = "left";
  } else if(id == "left"){
    document.querySelector(".tab-info-groups").id = "right";
  } else{
      document.querySelector(".tab-info-groups").id = "left";
  }
  
}

function new_rendu_professeur(){
  document.querySelector(".form_new_rendu").classList.add("active");
}
function new_rendu_etudiant(){
  document.querySelector(".form_new_rendu_etudiant").classList.add("active");
}
function inscription(){
  document.querySelector(".form-inscription").classList.add("active");
}



