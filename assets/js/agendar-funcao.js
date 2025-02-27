
const horaios = document.querySelector('.horaios');
const btn = document.querySelector('button');

function toggleHorarios(){
    btn.addEventListener("click", function () {
        horaios.classList.add('');
    })
}

// function toggleHorarios(botao) {
//     let horarios = botao.nextElementSibling;

//     if (horarios && horarios.classList.contains("horarios")) {
//         if (horarios.style.display === "none" || horarios.style.display === "") {
//             horarios.style.display = "block";
//             botao.innerText = "HORÁRIOS"; 
//         } else {
//             horarios.style.display = "none";
//             botao.innerText = "HORÁRIOS"; 
//         }
//     }
// }
