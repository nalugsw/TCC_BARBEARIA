document.addEventListener("DOMContentLoaded", () => {
    const produtos = document.querySelectorAll(".item-produto");
    const popup = document.getElementById("popup");
    const popupTitulo = document.getElementById("popup-titulo");
    const popupPreco = document.getElementById("popup-preco");
    const popupDescricao = document.getElementById("popup-descricao");
    const popupImg = document.getElementById("popup-img");
    const btnFechar = document.querySelector(".btn-fechar");

    produtos.forEach(produto => {
        produto.addEventListener("click", () => {
            const titulo = produto.getAttribute("data-titulo");
            const preco = produto.getAttribute("data-preco");
            const descricao = produto.getAttribute("data-descricao");
            const imgSrc = produto.querySelector(".img-produto img").src; // Substitua com descrições reais

            popupTitulo.textContent = titulo;
            popupPreco.textContent = preco;
            popupDescricao.textContent = descricao;
            popupImg.src = imgSrc;

            popup.style.display = "flex";
        });
    });

    btnFechar.addEventListener("click", () => {
        popup.style.display = "none";
    });

    popup.addEventListener("click", (e) => {
        if (e.target === popup) {
            popup.style.display = "none";
        }
    });
});