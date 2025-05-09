
  const btnSetting = document.getElementById("btn-setting");
  const btnVoltar = document.getElementById("btn-voltar-config");
  const menuPadrao = document.getElementById("menu-padrao");
  const menuSettings = document.getElementById("menu-settings");

  const btnSettingMob = document.getElementById("btn-setting-mobile");
  const btnVoltarMob = document.getElementById("btn-voltar-config-mobile");
  const menuPadraoMob = document.getElementById("menu-padrao-mobile");
  const menuSettingsMob = document.getElementById("menu-settings-mobile");

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

  //mobile 
  btnSettingMob.addEventListener("click", function(event) {
    event.preventDefault(); // Impede que o <a href=""> recarregue a página
    menuPadraoMob.classList.add("hide");
    menuSettingsMob.classList.remove("hide");
  });

  // Volta para o menu padrão
  btnVoltarMob.addEventListener("click", function(event) {
    event.preventDefault();
    menuSettingsMob.classList.add("hide");
    menuPadraoMob.classList.remove("hide");
  });
