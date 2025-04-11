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
    <h1>Agendar</h1>
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
    </div>

    </main>

    
</body>

<script src="../../assets/js/modal.js"></script>
<script src="../../assets/js/modal-deslogar.js"></script>
<script src="../../assets/js/modal-selecionar.js"></script>
<script src="../../assets/js/submenu-funcao.js"></script>
<script src="../../assets/js/agendar-funcao.js"></script>
</html>