document.addEventListener("DOMContentLoaded", function () {
  let modalEditar = document.getElementById("modal-edit"); 
  let cancelar = document.getElementById("cancelar-edit");
  let btnEdits = document.querySelectorAll(".btn-edit"); 

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

