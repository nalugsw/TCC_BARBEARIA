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
        
        // Mapeamento das páginas para identificação (adaptado para usuário)
        const pageMapping = {
            'agendamentos.php': 'agendamentos',
            'perfil.php': 'perfil', 
            'historico.php': 'historico',
            'servicos.php': 'servicos',
            'favoritos.php': 'favoritos'
        };
        
        const currentPageKey = pageMapping[currentPage];
        
        // Remover classe 'active' de todos os itens de menu
        const allMenuItems = document.querySelectorAll('.item-menu, .item-menu-mobile');
        allMenuItems.forEach(item => {
            item.classList.remove('active');
        });
        
        // Marcar item ativo no menu desktop
        const desktopMenuItems = document.querySelectorAll('.menu-lateral-desktop .item-menu');
        desktopMenuItems.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                const href = link.getAttribute('href');
                const linkPage = href.split('/').pop();
                
                if (linkPage === currentPage) {
                    item.classList.add('active');
                    
                    // Adiciona efeito visual especial para o item ativo
                    item.style.backgroundColor = '#232323';
                    item.style.marginLeft = '5px';
                    item.style.marginRight = '5px';
                    item.style.paddingLeft = '31px';
                    item.style.borderRadius = '3px';
                    item.style.borderLeft = '2px solid #4065AB';
                    item.style.boxShadow = 'inset 0 0 10px rgba(64, 101, 171, 0.082)';
                    
                    const textLink = item.querySelector('.txt-link');
                    if (textLink) {
                        textLink.style.color = '#ffffff';
                        textLink.style.fontWeight = 'bold';
                    }
                }
            }
        });
        
        // Marcar item ativo no menu mobile
        const mobileMenuItems = document.querySelectorAll('.menu-mobile .item-menu-mobile');
        mobileMenuItems.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                const href = link.getAttribute('href');
                const linkPage = href.split('/').pop();
                
                if (linkPage === currentPage) {
                    item.classList.add('active');
                    
                    // Estilos para mobile
                    item.style.backgroundColor = '#232323';
                    item.style.borderRadius = '3px';
                    item.style.padding = '10px';
                    item.style.borderLeft = '4px solid #4065AB';
                    
                    const textLink = item.querySelector('a');
                    if (textLink) {
                        textLink.style.color = '#ffffff';
                        textLink.style.fontWeight = 'bold';
                    }
                }
            }
        });
    }
    
    // Executar quando a página carregar
    setActiveMenuItem();
    
    // Adicionar efeito visual ao clicar (antes de navegar)
    const allLinks = document.querySelectorAll('.item-menu a, .item-menu-mobile a');
    allLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Remover active de todos
            const allItems = document.querySelectorAll('.item-menu, .item-menu-mobile');
            allItems.forEach(item => {
                item.classList.remove('active');
                
                // Resetar estilos
                item.style.backgroundColor = '';
                item.style.marginLeft = '';
                item.style.marginRight = '';
                item.style.paddingLeft = '';
                item.style.borderRadius = '';
                item.style.borderLeft = '';
                item.style.boxShadow = '';
            });
            
            // Adicionar active ao item clicado
            const parentItem = this.closest('.item-menu, .item-menu-mobile');
            if (parentItem) {
                parentItem.classList.add('active');
                
                // Aplicar estilos para o item ativo
                parentItem.style.backgroundColor = '#232323';
                parentItem.style.marginLeft = '5px';
                parentItem.style.marginRight = '5px';
                parentItem.style.paddingLeft = '31px';
                parentItem.style.borderRadius = '3px';
                parentItem.style.borderLeft = '2px solid #4065AB';
                parentItem.style.boxShadow = 'inset 0 0 10px rgba(64, 101, 171, 0.082)';
                
                const textLink = parentItem.querySelector('.txt-link') || parentItem.querySelector('a');
                if (textLink) {
                    textLink.style.color = '#ffffff';
                    textLink.style.fontWeight = 'bold';
                }
            }
        });
    });
    
    // Efeito de onda para o botão de sair (similar ao CSS)
    const btnSair = document.querySelector('.btn-sair');
    if (btnSair) {
        btnSair.addEventListener('click', function(e) {
            // Criar efeito de onda
            const wave = document.createElement('span');
            wave.className = 'wave';
            wave.style.position = 'absolute';
            wave.style.borderRadius = '50%';
            wave.style.backgroundColor = 'rgba(255, 255, 255, 0.4)';
            wave.style.transform = 'scale(0)';
            wave.style.animation = 'wave 0.6s linear';
            wave.style.pointerEvents = 'none';
            
            // Posicionar no clique
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            wave.style.width = size + 'px';
            wave.style.height = size + 'px';
            wave.style.left = e.clientX - rect.left - size/2 + 'px';
            wave.style.top = e.clientY - rect.top - size/2 + 'px';
            
            this.appendChild(wave);
            
            // Remover após animação
            setTimeout(() => {
                wave.remove();
            }, 600);
        });
    }
});

// Adicionar animação de onda
const style = document.createElement('style');
style.textContent = `
@keyframes wave {
    to {
        transform: scale(2);
        opacity: 0;
    }
}
`;
document.head.appendChild(style);