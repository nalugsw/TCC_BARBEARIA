document.addEventListener('DOMContentLoaded', function() {
document.querySelectorAll('.whatsBtn').forEach(button => {
    button.addEventListener('click', function() {
        try {
              // Encontra o input de número correspondente ao botão clicado
            const numeroInput = this.closest('.numero-cliente').querySelector('input[type="text"]');
            const numeroTelefone = numeroInput.value;
            
            if (!numeroTelefone || numeroTelefone.trim() === '') {
                mostrarFeedback(this, 'Nenhum número disponível', false);
                return;
            }

            const mensagem = encodeURIComponent('Olá, gostaria de falar sobre seu agendamento');
            const numeroFormatado = formatarNumeroWhatsApp(numeroTelefone);
            const whatsappUrl = `https://wa.me/${numeroFormatado}?text=${mensagem}`;
            
            setTimeout(() => {
                this.style.transform = 'scale(1)';
                window.open(whatsappUrl, '_blank');
            }, 200);
            
        } catch (error) {
            console.error('Erro ao abrir WhatsApp:', error);
            mostrarFeedback(this, 'Erro ao abrir WhatsApp', false);
        }
    });
});

  // Função para formatar o número
function formatarNumeroWhatsApp(numero) {
    let numeroLimpo = numero.replace(/\D/g, '');
    if (numeroLimpo.length >= 11 && !numeroLimpo.startsWith('55')) {
        numeroLimpo = '55' + numeroLimpo;
    }
    return numeroLimpo;
}

  // Função para mostrar feedback visual
function mostrarFeedback(button, mensagem, sucesso) {
    const feedbackAntigo = button.parentNode.querySelector('.whatsapp-feedback');
    if (feedbackAntigo) {
        feedbackAntigo.remove();
    }
    
    const feedback = document.createElement('div');
    feedback.className = `whatsapp-feedback ${sucesso ? 'success' : 'error'}`;
    feedback.textContent = mensagem;
    
    button.parentNode.appendChild(feedback);
    
    setTimeout(() => {
        feedback.remove();
    }, 2000);
}
});