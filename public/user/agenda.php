<?php
include("../../config/conexao.php");
session_start();
require("../../functions/helpers.php");
verificaSession("cliente");

$mensagemSucesso = isset($_SESSION['sucesso']) ? $_SESSION['sucesso']: "";
$mensagemErro = isset($_SESSION['erro']) ? $_SESSION['erro']: "";
unset($_SESSION['sucesso']);
unset($_SESSION['erro']);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Agendar</title>
    <link rel="stylesheet" href="../../assets/css/user/tela-agendar.css">
    <link rel="stylesheet" href="../../assets/css/user/tela-agendar-responsividade.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <?php include("../../views/nav-padrao.php"); ?>

    <main>
    <!-- <h1>Agendar</h1>
    <div class="info-barbeiro">
        <p>Você pode agendar um horário por aqui ou pela seção home>submenu do perfil do barbeiro caso desejar!</p>
    </div>
    <div class="agenda">
        <div class="dia">
            <div class="selecao-horaio">
                <span><p>12/09 - segunda</p></span>
                <button class="horarios-btn" onclick="toggleHorarios(this)">HORÁRIOS  <i class="bi bi-caret-down-fill"></i></button>
            </div>
            <div class="horarios" style="display: none;">
                <p>HORÁRIOS DISPONÍVEIS</p>
                <div class="horario-div">
                    <p><span>11:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>14:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>14:30</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>15:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>15:30</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>16:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>16:30</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>17:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
            </div>
        </div>
        <div class="dia">
            <div class="selecao-horaio">
                <span><p>12/09 - terça</p></span>
                <button class="horarios-btn" onclick="toggleHorarios(this)">HORÁRIOS  <i class="bi bi-caret-down-fill"></i></button>
            </div>
            <div class="horarios" style="display: none;">
                <p>HORÁRIOS DISPONÍVEIS</p>
                <div class="horario-div">
                    <p><span>11:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>14:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
            </div>
        </div>
        <div class="dia">
            <div class="selecao-horaio">
                <span><p>12/09 - quarta</p></span>
                <button class="horarios-btn" onclick="toggleHorarios(this)">HORÁRIOS  <i class="bi bi-caret-down-fill"></i></button>
            </div>
            <div class="horarios" style="display: none;">
                <p>HORÁRIOS DISPONÍVEIS</p>
                <div class="horario-div">
                    <p><span>11:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>14:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div> <div class="horario-div">
                    <p><span>11:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
                <div class="horario-div">
                    <p><span>14:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
            </div>
        </div>
        <div class="dia">
            <div class="selecao-horaio">
                <span><p>12/09 - quinta</p></span>
                <button class="horarios-btn" onclick="toggleHorarios(this)">HORÁRIOS  <i class="bi bi-caret-down-fill"></i></button>
            </div>
            <div class="horarios" style="display: none;">
                <p>HORÁRIOS DISPONÍVEIS</p>
                <div class="horario-div">
                    <p><span>11:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
            </div>
        </div>
        <div class="dia">
            <div class="selecao-horaio">
                <span><p>12/09 - sexta</p></span>
                <button class="horarios-btn" onclick="toggleHorarios(this)">HORÁRIOS  <i class="bi bi-caret-down-fill"></i></button>
            </div>
            <div class="horarios" style="display: none;">
                <p>HORÁRIOS DISPONÍVEIS</p>
                <div class="horario-div">
                    <p><span>11:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
            </div>
        </div>
        <div class="dia">
            <div class="selecao-horaio">
                <span><p>12/09 - sábado</p></span>
                <button class="horarios-btn" onclick="toggleHorarios(this)">HORÁRIOS  <i class="bi bi-caret-down-fill"></i></button>
            </div>
            <div class="horarios" style="display: none;">
                <p>HORÁRIOS DISPONÍVEIS</p>
                <div class="horario-div">
                    <p><span>11:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
            </div>
        </div>
        <div class="dia">
            <div class="selecao-horaio">
                <span><p>12/09 - domingo</p></span>
                <button class="horarios-btn-fechado" onclick="toggleHorarios()">FECHADO  <i class="bi bi-x-square-fill"></i> </button>
            </div>
        </div>
    </div>

    <div id="popup" class="popup">
        <div class="popup-container">
            <div class="popup-form">
                <form action="">
                <span class="btn-fechar"><i class="bi bi-x-circle-fill"></i></span>
                <label for="nome">DIA</label>
                <input type="date" placeholder="00/00/0000" id="dia" name="dia">
                <label for="nome">HORARIO</label>
                <input type="time" placeholder="00/00/0000" id="dia" name="dia">
                <label for="nome">SERVIÇOS</label>
                <select name="servicos" id="servicos">
                    <option value="servico0">NENHUM HORÁRIO SELECIONADO</option>
                    <option value="servico1">Corte + Barba</option>
                    <option value="servico1">Sombracelha</option>
                    <option value="servico1">Corte</option>
                    <option value="servico1">Pézinho</option>
                </select>

                <div class="btn-login">
                    <a ><button type="submit">MARCAR HORÁRIO</button></a>
                </div>
                </form>
            </div>

        </div>
    </div> -->

    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Agendamento</title>
    <link rel="stylesheet" href="../calendario/css/estilo.css">
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
            <form action="../calendario/processa_agenda.php" method="post">
                <input type="hidden" id="dataAgendamento" name="dataAgendamento">
                <input type="hidden" id="horaAgendamento" name="horaAgendamento">
                
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" required>
                </div>
                
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
            fetch(`../calendario/includes/funcoes.php?acao=buscaHorarios&data=${ano}-${mes}-${dia}`)
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

    </main>

    
</body>

<script src="../../assets/js/modal.js"></script>
<script src="../../assets/js/modal-deslogar.js"></script>
<script src="../../assets/js/modal-selecionar.js"></script>
<script src="../../assets/js/submenu-funcao.js"></script>
<script src="../../assets/js/agendar-funcao.js"></script>
</html>