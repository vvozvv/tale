document.addEventListener('DOMContentLoaded', function(){
    const mobileHeader =  document.querySelector('.mm')
    const mobileBoard =  document.querySelector('.mobile-board')

    let mobileMenu = function (e) {
        mobileBoard.classList.toggle('active')
    }



    mobileHeader.addEventListener('click', mobileMenu);

})
