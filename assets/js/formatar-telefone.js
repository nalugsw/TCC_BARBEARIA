
window.onload = function () {
  let telefoneInput = document.getElementById("telefone");

  if (telefoneInput) {
      let numero = telefoneInput.placeholder.replace(/\D/g, ""); // Remove oq n é numero
      if (numero.length === 11) {
          telefoneInput.value = `(${numero.slice(0, 2)}) ${numero.slice(2, 7)}-${numero.slice(7, 11)}`;
      } else if (numero.length === 10) {
          telefoneInput.value = `(${numero.slice(0, 2)}) ${numero.slice(2, 6)}-${numero.slice(6, 10)}`;
      }
  }
};
