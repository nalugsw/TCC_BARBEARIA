<?php

include("../../config/conexao.php");
session_start();
include("../../functions/helpers.php");
verificaSession("cliente");
include("../../functions/user/home.php");
include("../../functions/informacoes.php");
$produtos = mostrarServicos();
$portfolio = mostrarImagemPortfolio();
$funcionario = dadosFuncionario();
$informacoes = buscarInformacoes();
$endereco = $informacoes['endereco'];
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
</head>
<body>
    <?php include("../../views/nav-padrao.php"); ?>

    <section class="home">
        <div class="container-home">
            <div class="profile-pic">
                <img src="../../<?php echo $funcionario['foto']; ?>" alt="">
            </div>
            <div class="informacoes-home">
                <h1><?php echo $funcionario['nome']; ?></h1>
                <div class="endereco-info">
                    <p><?php echo htmlspecialchars($endereco ?? 'Endereço não disponível'); ?></p>
                </div>
            </div>
            <div class="marcar-horario">
                <div class="btn-marcar-horario">
                    <a href="./agenda.php"><button>MARCAR HORARIO</button></a>
                </div>
            </div>
        </div>
        <div class="submenu">
            <button class="btn" data-target="grid1" >Destaques</button>
            <button class="btn" data-target="grid2" >Serviços</button>
        </div>
        <div class="grids-container">
            <div class="grid" id="grid1">
                <?php foreach ($portfolio as $imagemPortfolio): ?>
                    <div class="item-portifolio">
                        <img src="../../<?php echo $imagemPortfolio['imagem']; ?> " alt="">
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
        </div>
    </section>
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
                    // Último dia do mês
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
                        
                        const dataAtual = new Date(ano, mes - 1, dia);
                        const hoje = new Date();
                        hoje.setHours(0, 0, 0, 0);
                        

                        if (dataAtual < hoje || data.inativos.includes(`${ano}-${String(mes).padStart(2, '0')}-${String(dia).padStart(2, '0')}`)) {
                            diaElement.classList.add('inativo');
                        } else {
                            diaElement.onclick = function() { selecionaDia(this, ano, mes, dia); };
                        }
                        
        
                        const dataStr = `${ano}-${String(mes).padStart(2, '0')}-${String(dia).padStart(2, '0')}`;
                        if (data.agendamentos[dataStr] && data.agendamentos[dataStr].length > 0) {
                            diaElement.classList.add('com-agendamento');
                        }
                        
                        diasCalendario.appendChild(diaElement);
                    }
                });
        }

        function selecionaDia(elemento, ano, mes, dia) {

            const dataSelecionada = new Date(ano, mes - 1, dia);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('dataSelecionadaTitulo').textContent = 
                dataSelecionada.toLocaleDateString('pt-BR', options);
            
          
            document.getElementById('dataAgendamento').value = 
                `${ano}-${String(mes).padStart(2, '0')}-${String(dia).padStart(2, '0')}`;
            
         
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