document.addEventListener('DOMContentLoaded', function() {
    // Elementos principais
    const containerCadastro = document.getElementById('container-cadastro');
    const containerEdicao = document.getElementById('container-edicao');
    const botoesEditar = document.querySelectorAll('.icone-editar');
    const botaoCancelarEdicao = document.getElementById('cancelar-edicao');
    
    // Elementos de preview
    const previewCadastro = document.getElementById('preview');
    const previewEdicao = document.getElementById('preview-edicao');
    const inputFileCadastro = document.getElementById('arquivo');
    const inputFileEdicao = document.getElementById('arquivo-edicao');

    // Função para mostrar formulário de edição
    function mostrarFormEdicao(servicoData) {
        if (!containerCadastro || !containerEdicao) return;
        
        containerCadastro.style.display = 'none';
        containerEdicao.style.display = 'block';
        
        // Preenche os dados do formulário de edição
        if (document.getElementById('servico-id')) {
            document.getElementById('servico-id').value = servicoData.id || '';
        }
        if (document.getElementById('nome-servico')) {
            document.getElementById('nome-servico').value = servicoData.nome || '';
        }
        if (document.getElementById('preco-servico')) {
            document.getElementById('preco-servico').value = servicoData.valor || '';
        }
        if (document.getElementById('tempo-servico')) {
            document.getElementById('tempo-servico').value = servicoData.duracao || '00:00';
        }
        if (previewEdicao) {
            previewEdicao.src = servicoData.imagem || '';
            previewEdicao.style.display = 'block';
        }
        
        // Rolagem suave
        containerEdicao.scrollIntoView({ behavior: 'smooth' });
    }

    // Função para voltar ao cadastro
    function voltarParaCadastro() {
        if (containerCadastro && containerEdicao) {
            containerEdicao.style.display = 'none';
            containerCadastro.style.display = 'block';
            containerCadastro.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Configura botões de edição
    if (botoesEditar.length > 0) {
        botoesEditar.forEach(botao => {
            botao.addEventListener('click', function() {
                const itemServico = this.closest('.item');
                if (!itemServico) return;
                
                const servicoData = {
                    id: itemServico.dataset.id || '',
                    nome: itemServico.querySelector('h1')?.textContent || '',
                    valor: itemServico.querySelector('.preco p')?.textContent.replace('R$', '') || '0',
                    duracao: formatarTempoParaInput(itemServico.querySelector('.duracao')?.textContent || '0 min'),
                    imagem: itemServico.querySelector('img')?.src || ''
                };
                
                mostrarFormEdicao(servicoData);
            });
        });
    }

    // Configura botão de cancelar
    if (botaoCancelarEdicao) {
        botaoCancelarEdicao.addEventListener('click', voltarParaCadastro);
    }

    // Formata tempo para o input type="time"
    function formatarTempoParaInput(tempoString) {
        const minutos = parseInt(tempoString.replace(' min', '')) || 0;
        const horas = Math.floor(minutos / 60);
        const minsRestantes = minutos % 60;
        return `${horas.toString().padStart(2, '0')}:${minsRestantes.toString().padStart(2, '0')}`;
    }

    // Funções para preview de imagem (versão melhorada)
    function setupImagePreview(inputElement, previewElement) {
        if (!inputElement || !previewElement) return;
        
        inputElement.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                previewElement.src = e.target.result;
                previewElement.style.display = 'block';
                
                // Para formulário de edição, atualiza também a visualização
                if (previewElement.id === 'preview-edicao') {
                    previewElement.dataset.changed = 'true';
                }
            };
            reader.readAsDataURL(file);
        });
    }

    // Inicializa os previews de imagem
    setupImagePreview(inputFileCadastro, previewCadastro);
    setupImagePreview(inputFileEdicao, previewEdicao);
});