<!-- Estrutura do Menu Para Desktop(computadores e laptops) -->
<nav class="menu-lateral-desktop">
    <div class="logo">
        <img src="<?php echo BASE_URL; ?>assets/img/LOGO.png" alt="">
    </div>

    <ul>
        <li class="item-menu">
            <a href="<?php echo BASE_URL ?>public/user/perfil.php">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-perfil.png" alt="">
                <span class="txt-link">Perfil</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="<?php echo BASE_URL; ?>public/user/home.php">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-home.png" alt="">
                <span class="txt-link">Home</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="<?php echo BASE_URL; ?>public/user/produtos.php">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-produtos.png" alt="">
                <span class="txt-link">Produtos</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="#">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-informacoes.png" alt="">
                <span class="txt-link">Informações</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="#">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-agendar.png" alt="">
                <span class="txt-link">Agendar</span>
            </a>
        </li>
    </ul>

    <button id="btn-sair" class="btn-sair"><img src="<?php echo BASE_URL; ?>assets/img/icon-sair.png" alt="">SAIR</button>

</nav>


<dialog close id="modal-sair" >
    <div class="modal-sair">
        <p>realmente deseja sair?</p>
        <div class="btns-modal">
            <a href="<?php echo BASE_URL; ?>functions/logout.php">
                <button class="btn-sair">Sair</button>
            </a>
            <button id="cancelar">Voltar</button>
        </div>
    </div>
</dialog>