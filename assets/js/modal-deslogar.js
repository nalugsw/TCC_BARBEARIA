(function() {
  let modalSair = document.getElementById("modal-sair");
  let cancelar = document.getElementById("cancelar-sair");
  let btnSair = document.getElementById("btn-sair");
  let btnSairMobile = document.getElementById("btn-sair-mobile");

  btnSair.addEventListener("click", function(){
    modalSair.showModal();
  })
  cancelar.addEventListener("click", function(){
    modalSair.close();
  })

  
  btnSairMobile.addEventListener("click", function(){
    modalSair.showModal();
  })
  cancelar.addEventListener("click", function(){
    modalSair.close();
  })
})();