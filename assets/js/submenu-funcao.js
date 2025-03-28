document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".btn");
    const grids = document.querySelectorAll(".grid");

    grids[0].classList.add("ativo");
    buttons[0].classList.add("ativo");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            // Faz com que remova o termozinho 'ativo' de todos os botões
            buttons.forEach(btn => btn.classList.remove("ativo"));
            // Adiciona o termozinho 'ativo' só no botão que for clicado
            button.classList.add("ativo");

            // Esconde todos os grids quando nada tiver clicado
            grids.forEach(grid => grid.classList.remove("ativo"));

            // Mostra o grid correspondente ao botão que foi clicado
            const targetGrid = document.getElementById(button.dataset.target);
            targetGrid.classList.add("ativo");
        });
    });
});