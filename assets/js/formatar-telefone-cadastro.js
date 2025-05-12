document.addEventListener("DOMContentLoaded", function () {
    let cleave = new Cleave('#numero_telefone', {
      delimiters: ['(', ') ', '-'],
      blocks: [0, 2, 5, 4],
      numericOnly: true,
    });
  
    document.querySelector('form').addEventListener('submit', function(e) {
      let input = document.getElementById('numero_telefone');
      let numeroLimpo = cleave.getRawValue(); // remove máscara (fica só os números)
  
      // Validação: precisa ter 11 dígitos (2 do DDD + 9 do número)
      if (numeroLimpo.length !== 11) {
        e.preventDefault(); // bloqueia o envio
        alert("Por favor, insira um número de telefone válido com DDD e 9 dígitos.");
        input.focus();
        return;
      }
  
      // Se estiver tudo certo, substitui o valor no input pelo número limpo
      input.value = numeroLimpo;
    });
  });
  