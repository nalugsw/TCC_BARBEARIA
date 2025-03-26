document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popup");
    const btnFechar = document.querySelector(".btn-fechar");
    const btnsSelecionar = document.querySelectorAll(".selecionar");

    // Função para abrir o pop-up
    btnsSelecionar.forEach((btn) => {
        btn.addEventListener("click", function () {
            popup.style.display = "block"; // Exibe o pop-up
        });
    });

    // Função para fechar o pop-up
    btnFechar.addEventListener("click", function () {
        popup.style.display = "none"; // Esconde o pop-up
    });

    // Fecha o pop-up ao clicar fora dele
    popup.addEventListener("click", function (event) {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });
});
