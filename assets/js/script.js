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
  scroll.classList.toggle("active" , window.scrollY > 1500);
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