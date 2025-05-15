<?php

include("../../config/conexao.php");
session_start();
include("../../functions/helpers.php");
verificaSession("cliente");
include("../../functions/user/home.php");
$produtos = mostrarServicos();
$portfolio = mostrarImagemPortfolio();

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
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/user/home.css">
    <link rel="stylesheet" href="../../assets/css/user/home-responsividade.css">
    <link rel="stylesheet" href="../../assets/css/user/perfil.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
</head>
<body>
    <?php include("../../views/nav-padrao.php"); ?>

    <section class="home">
        <div class="container-home">
            <div class="profile-pic">
                <img src="../../assets/img/foto-barbeiro-tela-home.png" alt="">
            </div>
            <div class="informacoes-home">
                <h1>João Pereira</h1>
                <div class="estrelas-icons">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                </div>
                <div class="endereco-info">
                    <p>Estrada Plinio Dias, n°171 -
                        Itapecerica da Serra</p>
                </div>
            </div>
            <div class="marcar-horario">
                <div class="btn-marcar-horario">
                    <a href="./agenda.php"><button>MARCAR HORARIO</button></a>
                </div>
            </div>
        </div>
        <div class="submenu">
            <button class="btn" data-target="grid1" >Portfolio</button>
            <button class="btn" data-target="grid2" >Serviços</button>
        </div>
        <div class="grids-container">
            <div class="grid" id="grid1">
                <?php foreach ($portfolio as $imagemPortfolio): ?>
                    <div class="item-portifolio">
                        <img src="../../uploads/portfolio/<?php echo $imagemPortfolio['imagem']; ?> " alt="">
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="grid" id="grid2">
                <?php foreach ($produtos as $produto): ?>
                    <div class="item">
                        <img src="../../<?php echo $produto['foto']; ?>" alt="">
                        <div class="txt-teste">
                            <h1><?php echo $produto['nome']; ?></h1>
                            <div class="preco">
                                <p><?php echo $produto['valor']; ?> R$</p>
                                <div class="duracao"><p><?php $duracaoEmMinutos = (int)date('i', strtotime($produto['duracao'])) . " min";
                                echo $duracaoEmMinutos; ?></p></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="grid" id="grid3">
                <div class="container">
                <h1>Agende seu horário</h1>
                    
                <div id="calendario">
                    <input type="month" id="mesSelecionado" onchange="carregaCalendario()">
                    <div id="diasCalendario"></div>
                </div>
                    
                <h2 id="dataSelecionadaTitulo" style="display: none;"></h2>
                <div id="horariosContainer" style="display:none;">
                        <h3 id="TituloDia">horarios selecionados</h3>
                        <div id="horariosDisponiveis" class="horariosDisponiveis" ></div>
                        <div id="formularioAgendamento" style="display:none;">
                            <h2>Selecione o Serviço</h2>
                            <form action="../calendario/processa_agenda.php" method="post">
                                <input type="hidden" id="dataAgendamento" name="dataAgendamento">
                                <input type="hidden" id="horaAgendamento" name="horaAgendamento">
                                
                                <div class="form-group">
                                    <select name="servico" id="servico" required>
                                        <?php foreach($servicos as $servico): ?>
                                            <option value="<?php echo $servico['id_servico']; ?>"><?php echo $servico['nome']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <button type="submit">Confirmar Agendamento</button>
                            </form>
                        </div>
                </div>
            </div>
            
        </div>
    </section>
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
                            document.querySelectorAll('.botao-horario').forEach(btn => {
                                btn.classList.remove('botao-horario-select');
                            });
                            selecionaHorario(horario);
                            botaoHorario.classList.add('botao-horario-select');
                            const formAgend = document.getElementById('formularioAgendamento');
                            const divHorarios = document.getElementById('horariosDisponiveis');
                            formAgend.classList.add('formularioAgendamento-select');
                            divHorarios.classList.add('horariosDisponiveis-select')
                        };
                        container.appendChild(botaoHorario);
                    });
                    
                    // Mostra o container de horários
                    document.getElementById('horariosContainer').style.display = 'grid';
                    document.getElementById('dataSelecionadaTitulo').style.display = 'block';
                    document.getElementById('formularioAgendamento').style.display = 'none';
                });
        }

        function selecionaHorario(horario) {
            document.getElementById('horaAgendamento').value = horario;
            document.getElementById('formularioAgendamento').style.display = 'block';
        }
    </script>

    <script src="../../assets/js/modal.js"></script>
    <script src="../../assets/js/modal-deslogar.js"></script>
    <script src="../../assets/js/submenu-funcao.js"></script>
    <script src="../../assets/js/agendar-funcao.js"></script>
    <script src="../../assets/js/agendar-funcao.js"></script>
</body>
</html>