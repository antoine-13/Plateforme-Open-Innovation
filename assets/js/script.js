window.addEventListener('scroll', function(){
    var scroll = document.querySelector('.gotop');
    scroll.classList.toggle("active" , window.scrollY > 500);
})

function gotop(){
    window.scrollTo({
        top: 0
    })
}