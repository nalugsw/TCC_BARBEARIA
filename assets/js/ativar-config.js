
  const btnSetting = document.getElementById("btn-setting");
  const btnVoltar = document.getElementById("btn-voltar-config");
  const menuPadrao = document.getElementById("menu-padrao");
  const menuSettings = document.getElementById("menu-settings");

  btnSetting.addEventListener("click", function(event) {
    event.preventDefault(); // Impede que o <a href=""> recarregue a página
    menuPadrao.classList.add("hide");
    menuSettings.classList.remove("hide");
  });

  // Volta para o menu padrão
  btnVoltar.addEventListener("click", function(event) {
    event.preventDefault();
    menuSettings.classList.add("hide");
    menuPadrao.classList.remove("hide");
  });
