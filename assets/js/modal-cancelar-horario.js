btnEdits.forEach(btn => {
    btn.addEventListener("click", function (event) {
        event.preventDefault();
        const idAgendamento = btn.getAttribute("data-id");
        document.getElementById("input-id-agendamento").value = idAgendamento;
        modalEditar.showModal();
    });
});
