document.addEventListener('DOMContentLoaded', function() {
    
    // Função para obter o nome da página atual
    function getCurrentPage() {
        const path = window.location.pathname;
        const page = path.split('/').pop(); // Pega o último segmento da URL
        return page;
    }
    
    // Função para marcar o item ativo baseado na página atual
    function setActiveMenuItem() {
        const currentPage = getCurrentPage();
        
        // Mapeamento das páginas para identificação
        const pageMapping = {
            'horarios.php': 'horarios',
            'perfil.php': 'perfil', 
            'servicos.php': 'servicos',
            'produtos.php': 'produtos',
            'relatorios.php': 'relatorios',
            'informacoes.php': 'informacoes',
            'editarHorarios.php': 'editarHorarios'
        };
        
        const currentPageKey = pageMapping[currentPage];
        
        // Remover classe 'active' de todos os itens de menu
        const allMenuItems = document.querySelectorAll('.item-menu, .item-menu-mobile');
        allMenuItems.forEach(item => {
            item.classList.remove('active');
        });
        
        // Marcar item ativo no menu desktop
        const desktopMenuItems = document.querySelectorAll('#menu-padrao .item-menu');
        desktopMenuItems.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                const href = link.getAttribute('href');
                const linkPage = href.split('/').pop();
                
                if (linkPage === currentPage) {
                    item.classList.add('active');
                }
            }
        });
        
        // Marcar item ativo no menu mobile
        const mobileMenuItems = document.querySelectorAll('#menu-padrao-mobile .item-menu-mobile');
        mobileMenuItems.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                const href = link.getAttribute('href');
                const linkPage = href.split('/').pop();
                
                if (linkPage === currentPage) {
                    item.classList.add('active');
                }
            }
        });
        
        // Marcar item ativo no menu de configurações desktop
        const settingsMenuItems = document.querySelectorAll('#menu-settings .item-menu');
        settingsMenuItems.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                const href = link.getAttribute('href');
                const linkPage = href.split('/').pop();
                
                if (linkPage === currentPage) {
                    item.classList.add('active');
                }
            }
        });
        
        // Marcar item ativo no menu de configurações mobile
        const settingsMobileItems = document.querySelectorAll('#menu-settings-mobile .item-menu');
        settingsMobileItems.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                const href = link.getAttribute('href');
                const linkPage = href.split('/').pop();
                
                if (linkPage === currentPage) {
                    item.classList.add('active');
                }
            }
        });
    }
    
    // Executar quando a página carregar
    setActiveMenuItem();
    
    // Opcional: Adicionar efeito visual ao clicar (antes de navegar)
    const allLinks = document.querySelectorAll('.item-menu a, .item-menu-mobile a');
    allLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Remover active de todos
            const allItems = document.querySelectorAll('.item-menu, .item-menu-mobile');
            allItems.forEach(item => item.classList.remove('active'));
            
            // Adicionar active ao item clicado
            const parentItem = this.closest('.item-menu, .item-menu-mobile');
            if (parentItem) {
                parentItem.classList.add('active');
            }
        });
    });
});