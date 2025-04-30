<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Agendamento</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Agende seu horário</h1>
        
        <div id="calendario">
            <input type="month" id="mesSelecionado" onchange="carregaCalendario()">
            <div id="diasCalendario"></div>
        </div>
        
        <div id="horariosContainer" style="display:none;">
            <h2 id="dataSelecionadaTitulo"></h2>
            <div id="horariosDisponiveis"></div>
        </div>
        
        <div id="formularioAgendamento" style="display:none;">
            <h2>Preencha seus dados</h2>
            <form action="processa_agenda.php" method="post">
                <input type="hidden" id="dataAgendamento" name="dataAgendamento">
                <input type="hidden" id="horaAgendamento" name="horaAgendamento">
                
                <button type="submit">Confirmar Agendamento</button>
            </form>
        </div>
    </div>

    <script>
        // Carrega o calendário ao abrir a página
        window.onload = function() {
            carregaCalendario();
        };

        function carregaCalendario() {
            const mesInput = document.getElementById('mesSelecionado');
            const dataAtual = new Date();
            let mes, ano;
            
            if (mesInput.value) {
                [ano, mes] = mesInput.value.split('-');
            } else {
                mesInput.value = `${dataAtual.getFullYear()}-${String(dataAtual.getMonth() + 1).padStart(2, '0')}`;
                ano = dataAtual.getFullYear();
                mes = dataAtual.getMonth() + 1;
            }
            
            // Buscar dias inativos e agendamentos via AJAX
            fetch(`includes/funcoes.php?acao=carregaCalendario&ano=${ano}&mes=${mes}`)
                .then(response => response.json())
                .then(data => {
                    const diasCalendario = document.getElementById('diasCalendario');
                    diasCalendario.innerHTML = '';
                    
                    // Cria cabeçalho dos dias da semana
                    const diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
                    diasSemana.forEach(dia => {
                        const diaSemanaElement = document.createElement('div');
                        diaSemanaElement.className = 'dia-semana';
                        diaSemanaElement.textContent = dia;
                        diasCalendario.appendChild(diaSemanaElement);
                    });
                    
                    // Primeiro dia do mês
                    const primeiroDia = new Date(ano, mes - 1, 1);
                    // Último dia do mês
                    const ultimoDia = new Date(ano, mes, 0);
                    // Dias do mês anterior para preencher o calendário
                    const diasMesAnterior = primeiroDia.getDay();
                    // Total de dias no mês
                    const totalDias = ultimoDia.getDate();
                    
                    // Preenche com dias do mês anterior (se necessário)
                    for (let i = 0; i < diasMesAnterior; i++) {
                        const diaElement = document.createElement('div');
                        diaElement.className = 'dia outro-mes';
                        diasCalendario.appendChild(diaElement);
                    }
                    
                    // Preenche os dias do mês atual
                    for (let dia = 1; dia <= totalDias; dia++) {
                        const diaElement = document.createElement('div');
                        diaElement.className = 'dia';
                        diaElement.textContent = dia;
                        
                        const dataAtual = new Date(ano, mes - 1, dia);
                        const hoje = new Date();
                        hoje.setHours(0, 0, 0, 0);
                        
                        // Verifica se é um dia passado ou inativo
                        if (dataAtual < hoje || data.inativos.includes(`${ano}-${String(mes).padStart(2, '0')}-${String(dia).padStart(2, '0')}`)) {
                            diaElement.classList.add('inativo');
                        } else {
                            diaElement.onclick = function() { selecionaDia(this, ano, mes, dia); };
                        }
                        
                        // Marca dias com agendamentos
                        const dataStr = `${ano}-${String(mes).padStart(2, '0')}-${String(dia).padStart(2, '0')}`;
                        if (data.agendamentos[dataStr] && data.agendamentos[dataStr].length > 0) {
                            diaElement.classList.add('com-agendamento');
                        }
                        
                        diasCalendario.appendChild(diaElement);
                    }
                });
        }

        function selecionaDia(elemento, ano, mes, dia) {
            // Formata a data selecionada
            const dataSelecionada = new Date(ano, mes - 1, dia);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('dataSelecionadaTitulo').textContent = 
                dataSelecionada.toLocaleDateString('pt-BR', options);
            
            // Armazena a data selecionada no formulário
            document.getElementById('dataAgendamento').value = 
                `${ano}-${String(mes).padStart(2, '0')}-${String(dia).padStart(2, '0')}`;
            
            // Busca horários disponíveis via AJAX
            fetch(`includes/funcoes.php?acao=buscaHorarios&data=${ano}-${mes}-${dia}`)
                .then(response => response.json())
                .then(horarios => {
                    const container = document.getElementById('horariosDisponiveis');
                    container.innerHTML = '';
                    
                    horarios.forEach(horario => {
                        const botaoHorario = document.createElement('button');
                        botaoHorario.className = 'botao-horario';
                        botaoHorario.textContent = horario;
                        botaoHorario.onclick = function() {
                            selecionaHorario(horario);
                        };
                        container.appendChild(botaoHorario);
                    });
                    
                    // Mostra o container de horários
                    document.getElementById('horariosContainer').style.display = 'block';
                    document.getElementById('formularioAgendamento').style.display = 'none';
                });
        }

        function selecionaHorario(horario) {
            document.getElementById('horaAgendamento').value = horario;
            document.getElementById('formularioAgendamento').style.display = 'block';
        }
    </script>
</body>
</html>