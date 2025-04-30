document.addEventListener("DOMContentLoaded", function () {
  let modalEditar = document.getElementById("cancelar-horario"); 
  let cancelar = document.getElementById("btn-voltar");
  let btnEdits = document.querySelectorAll(".btn-cancelar-horario"); 

  if (modalEditar && cancelar && btnEdits.length > 0) {
      btnEdits.forEach(btn => {
          btn.addEventListener("click", function (event) {
              event.preventDefault(); //nao carrega a pagina
              modalEditar.showModal();
          });
      });

      cancelar.addEventListener("click", function () {
          modalEditar.close();
      });
  } else {
      console.error("Erro: Elementos do modal não encontrados.");
  }
});
