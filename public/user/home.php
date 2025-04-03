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
    <link rel="stylesheet" href="../../assets/css/user/agendar.css">
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
            <div class="foto-home">
                <div class="profile-pic"></div>
            </div>
            <div class="informacoes-home">
                <h1>Luis Pereira</h1>
                <div class="estrelas-icons">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                </div>
                <div class="endereco-info">
                    <p>Rua naoseioque, n°171 -
                        Jardim setadoido</p>
                </div>
            </div>
            <div class="marcar-horario">
                <div class="btn-marcar-horario">
                    <a href="#"><button>MARCAR HORARIO</button></a>
                </div>
            </div>
        </div>
        <div class="submenu">
            <button class="btn" data-target="grid1" >Portfolio</button>
            <button class="btn" data-target="grid2" >Serviços</button>
            <button class="btn" data-target="grid3" onclick="showHorarios()">Agenda</button>
        </div>
        <div class="grids-container">
            <div class="grid" id="grid1">
                <?php foreach ($portfolio as $imagemPortfolio): ?>
                    <div class="item"><img src="../../uploads/portfolio/<?php echo $imagemPortfolio['imagem']; ?> " alt=""></div>
                <?php endforeach; ?>
            </div>

            <div class="grid" id="grid2">
                <?php foreach ($produtos as $produto): ?>
                    <div class="item">
                        <img src="../../<?php echo $produto['foto']; ?>" alt="">
                        <div class="txt-teste">
                            <h1><?php echo $produto['nome']; ?></h1>
                            <div class="preco">
                                <p><?php echo $produto['valor']; ?></p>
                                <div class="duracao"><?php $duracaoEmMinutos = (int)date('i', strtotime($produto['duracao'])) . " min";
                                echo $duracaoEmMinutos; ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="grid" id="grid3">
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
            </div>
            
        </div>
    </section>

    <script src="../../assets/js/modal.js"></script>
    <script src="../../assets/js/modal-deslogar.js"></script>
    <script src="../../assets/js/submenu-funcao.js"></script>
    <script src="../../assets/js/agendar-funcao.js"></script>
</body>
</html>