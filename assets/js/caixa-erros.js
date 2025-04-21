document.addEventListener('DOMContentLoaded', function() {
    // Ativa as animações de entrada
    requestAnimationFrame(function() {
        const errorBox = document.querySelector('.error-box');
        const correctBox = document.querySelector('.correct-box');
        
        if(errorBox) errorBox.classList.add('show');
        if(correctBox) correctBox.classList.add('show');
        
        // Configura o desaparecimento após 5 segundos
        setTimeout(() => {
            if(errorBox) {
                errorBox.classList.remove('show');
                errorBox.addEventListener('transitionend', function() {
                    if(!errorBox.classList.contains('show')) {
                        errorBox.style.display = 'none';
                    }
                });
            }
            
            if(correctBox) {
                correctBox.classList.remove('show');
                correctBox.addEventListener('transitionend', function() {
                    if(!correctBox.classList.contains('show')) {
                        correctBox.style.display = 'none';
                    }
                });
            }
        }, 5000);
    });
});