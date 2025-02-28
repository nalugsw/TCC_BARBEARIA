
function toggleHorarios(button) {
    // Encontrar o elemento pai da div 'selecao-horaio'
    const diaDiv = button.closest('.dia');

    // Encontrar a div 'horarios' dentro deste dia específico
    const horariosDiv = diaDiv.querySelector('.horarios');

    // Verificar se a div está visível e mostrar ou esconder
    if (horariosDiv.style.display === "none" || horariosDiv.style.display === "") {
        horariosDiv.style.display = "block";
        button.classList.add("ativo");
    } else {
        horariosDiv.style.display = "none";
        button.classList.remove("ativo");
    }
}

