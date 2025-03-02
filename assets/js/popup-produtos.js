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
            const titulo = produto.querySelector(".txt-produto h2").textContent;
            const preco = produto.querySelector(".txt-produto p").textContent;
            const imgSrc = produto.querySelector(".img-produto img").src;
            const descricao = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing"; // Substitua com descrições reais

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