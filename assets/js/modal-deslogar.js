(function() {
  let modalSair = document.getElementById("modal-sair");
  let cancelar = document.getElementById("cancelar-sair");
  let btnSair = document.getElementById("btn-sair");

  btnSair.addEventListener("click", function(){
    modalSair.showModal();
  })
  cancelar.addEventListener("click", function(){
    modalSair.close();
  })
})();