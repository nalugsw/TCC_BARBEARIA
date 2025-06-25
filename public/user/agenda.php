<?php
include("../../config/conexao.php");
session_start();
require("../../functions/helpers.php");
verificaSession("cliente");
$funcionarios = dadosFuncionario();
require_once("../../functions/user/home.php");
$servicos = mostrarServicos();

$mensagemSucesso = isset($_SESSION['sucesso']) ? $_SESSION['sucesso'] : "";
$mensagemErro = isset($_SESSION['erro']) ? $_SESSION['erro'] : "";
unset($_SESSION['sucesso']);
unset($_SESSION['erro']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Agendar</title>
    <link rel="stylesheet" href="../../assets/css/user/agenda.css">
    <link rel="stylesheet" href="../../assets/css/user/agenda-responsividade.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include("../../views/nav-padrao.php"); ?>
    <div class="container">
        <h1>Agende seu horário</h1>
        
        <div id="calendario">
            <input type="month" id="mesSelecionado" onchange="carregaCalendario()">
            <div id="diasCalendario"></div>
        </div>
        
        <h2 id="dataSelecionadaTitulo" style="display: none;"></h2>
        <div id="horariosContainer" style="display:none;">
            <h3 id="TituloDia">horarios selecionados</h3>
            <div id="horariosDisponiveis" class="horariosDisponiveis"></div>
            <div id="formularioAgendamento" style="display:none;">
                <form action="../calendario/processa_agenda.php" method="POST">
                    <input type="hidden" id="dataAgendamento" name="dataAgendamento">
                    <input type="hidden" id="horaAgendamento" name="horaAgendamento">
                    
                    <div class="form-group">
    <h2>Selecione o Serviço</h2>
    <select name="servico" id="servico" required onchange="mostrarPreco()">
        <option value="" disabled selected>Selecione...</option> <!-- opção vazia -->
        <?php foreach($servicos as $servico): ?>
            <option value="<?= $servico['id_servico'] ?>" data-preco="<?= number_format($servico['valor'], 2, '.', '') ?>">
                <?= $servico['nome'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <div id="precoServico" style="display: none;">
        <p>Preço: <span id="valorServico"></span></p>
    </div>

    <input type="hidden" id="idFuncionario" name="id_funcionario" value="<?= $funcionarios['id_funcionario']; ?>">
</div>
                    <button type="submit">Agendar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
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
            
            fetch(`../calendario/includes/funcoes.php?acao=carregaCalendario&ano=${ano}&mes=${mes}`)
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
                    
              
                    const primeiroDia = new Date(ano, mes - 1, 1);
              
                    const ultimoDia = new Date(ano, mes, 0);
                
                    const diasMesAnterior = primeiroDia.getDay();
                 
                    const totalDias = ultimoDia.getDate();
                    
                    for (let i = 0; i < diasMesAnterior; i++) {
                        const diaElement = document.createElement('div');
                        diaElement.className = 'dia outro-mes';
                        diasCalendario.appendChild(diaElement);
                    }
                    

                    for (let dia = 1; dia <= totalDias; dia++) {
                        const diaElement = document.createElement('div');
                        diaElement.className = 'dia';
                        diaElement.textContent = dia;
                        
                        const dataDia = new Date(ano, mes - 1, dia);
                        const hoje = new Date();
                        hoje.setHours(0, 0, 0, 0);
                        
        
                        const doisSemanasDepois = new Date();
                        doisSemanasDepois.setDate(doisSemanasDepois.getDate() + 13); // hoje + 13 dias

           
                        const dataStr = `${ano}-${String(mes).padStart(2, '0')}-${String(dia).padStart(2, '0')}`;

                        if (dataDia < hoje || 
                            dataDia > doisSemanasDepois || 
                            (data.inativos && data.inativos.includes(dataStr))) {
                            diaElement.classList.add('inativo');
                        } else {
                            diaElement.onclick = function() { selecionaDia(this, ano, mes, dia); };
                        }

                
                        if (data.agendamentos && data.agendamentos[dataStr] && 
                            data.totalHorariosPorDia && data.totalHorariosPorDia[dataStr] &&
                            data.agendamentos[dataStr].length >= data.totalHorariosPorDia[dataStr]) {
                            diaElement.classList.add('com-agendamento');
                        }

                        diasCalendario.appendChild(diaElement);
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar calendário:', error);
                    document.getElementById('diasCalendario').innerHTML = '<p>Erro ao carregar o calendário. Tente recarregar a página.</p>';
                });
        }

        function selecionaDia(elemento, ano, mes, dia) {

    const dataSelecionada = new Date(ano, mes - 1, dia);
    const options = { weekday: 'long', year: 'numeric', month: 'numeric', day: 'numeric' };
    document.getElementById('dataSelecionadaTitulo').textContent = 
        dataSelecionada.toLocaleDateString('pt-BR', options);
    
 
    document.getElementById('dataAgendamento').value = 
        `${ano}-${String(mes).padStart(2, '0')}-${String(dia).padStart(2, '0')}`;
    

    fetch(`../calendario/includes/funcoes.php?acao=buscaHorarios&data=${ano}-${mes}-${dia}`)
        .then(response => response.json())
        .then(horarios => {
            const container = document.getElementById('horariosDisponiveis');
            const tituloDia = document.getElementById('TituloDia');
            container.innerHTML = '';
            
            if (horarios.length === 0) {
                tituloDia.style.display = 'none';
                container.innerHTML = '<p>Não há horários disponíveis para este dia</p>';
            } else {
                tituloDia.style.display = 'block'; 
                horarios.forEach(horario => {
                    const botaoHorario = document.createElement('button');
                    botaoHorario.className = 'botao-horario';
                    botaoHorario.textContent = horario;
                    botaoHorario.onclick = function() {
                        document.querySelectorAll('.botao-horario').forEach(btn => {
                            btn.classList.remove('botao-horario-select');
                        });
                        selecionaHorario(horario);
                        botaoHorario.classList.add('botao-horario-select');
                        const formAgend = document.getElementById('formularioAgendamento');
                        const divHorarios = document.getElementById('horariosDisponiveis');
                        formAgend.classList.add('formularioAgendamento-select');
                        divHorarios.classList.add('horariosDisponiveis-select');
                    };
                    container.appendChild(botaoHorario);
                });
            }
            
     
            document.getElementById('horariosContainer').style.display = 'grid';
            document.getElementById('dataSelecionadaTitulo').style.display = 'block';
            document.getElementById('formularioAgendamento').style.display = 'none';
            
            document.getElementById('horariosContainer').scrollIntoView({ behavior: 'smooth' });
        
        })
        .catch(error => {
            console.error('Erro ao buscar horários:', error);
            document.getElementById('horariosDisponiveis').innerHTML = '<p>Erro ao carregar horários. Tente novamente.</p>';
            document.getElementById('TituloDia').style.display = 'none'; 
        });
}

        function selecionaHorario(horario) {
            document.getElementById('horaAgendamento').value = horario;
            document.getElementById('formularioAgendamento').style.display = 'block';
        }
        function mostrarPreco() {
            const select = document.getElementById("servico");
            const preco = select.options[select.selectedIndex]?.getAttribute("data-preco");

            if (preco) {
                document.getElementById("valorServico").innerText = "R$ " + parseFloat(preco).toFixed(2);
                document.getElementById("precoServico").style.display = "block";
            } else {
                document.getElementById("valorServico").innerText = "";
                document.getElementById("precoServico").style.display = "none";
            }
}
        
    </script>

    <script src="../../assets/js/modal.js"></script>
    <script src="../../assets/js/modal-deslogar.js"></script>
    <script src="../../assets/js/modal-selecionar.js"></script>
    <script src="../../assets/js/agendar-funcao.js"></script>
</body>
</html>