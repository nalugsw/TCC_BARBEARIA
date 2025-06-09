document.addEventListener('DOMContentLoaded', function() {
    // Elementos principais
    const containerCadastro = document.getElementById('container-cadastro');
    const containerEdicao = document.getElementById('container-edicao');
    const botoesEditar = document.querySelectorAll('.icone-editar');
    const botaoCancelarEdicao = document.getElementById('cancelar-edicao');
    
    // Elementos de pré-visualização
    const previewCadastro = document.getElementById('preview');
    const previewEdicao = document.getElementById('preview-edicao');
    const inputFileCadastro = document.getElementById('arquivo');
    const inputFileEdicao = document.getElementById('arquivo-edicao');

    // Função para mostrar o formulário de edição
    function mostrarFormEdicao(dadosServico) {
        if (!containerCadastro || !containerEdicao) return;
        
        containerCadastro.style.display = 'none';
        containerEdicao.style.display = 'block';
        
        // Preenche os campos do formulário de edição
        const campoId = document.getElementById('id-servico');
        const campoNome = document.getElementById('nome-servico');
        const campoPreco = document.getElementById('preco-servico');
        const campoTempo = document.getElementById('tempo-servico');
        
        if (campoId) {
            campoId.value = dadosServico.id || '';
        }
        if (campoNome) {
            campoNome.value = dadosServico.nome || '';
        }
        if (campoPreco) {
            // Formata o valor (remove R$ e ajusta decimais)
            const valorNumerico = parseFloat(dadosServico.valor.replace('R$', '').replace(',', '.')) || 0;
            campoPreco.value = valorNumerico.toFixed(2);
        }
        if (campoTempo) {
            // Converte formato "X min" para "HH:MM"
            campoTempo.value = converterTempoParaFormatoInput(dadosServico.duracao);
        }
        if (previewEdicao) {
            // Trata o caminho da imagem
            let caminhoImagem = dadosServico.imagem;
            // Remove o caminho relativo se existir
            if (caminhoImagem.includes('../../')) {
                caminhoImagem = caminhoImagem.replace('../../', '');
            }
            previewEdicao.src = '../../' + caminhoImagem;
            previewEdicao.style.display = 'block';
        }
        
        // Rolagem suave até o formulário de edição
        containerEdicao.scrollIntoView({ behavior: 'smooth' });
    }

    // Função para converter tempo de "X min" para "HH:MM"
    function converterTempoParaFormatoInput(tempoString) {
        // Extrai o número de minutos
        const minutos = parseInt(tempoString.replace(' min', '')) || 0;
        const horas = Math.floor(minutos / 60);
        const minutosRestantes = minutos % 60;
        
        // Formata como HH:MM
        return `${horas.toString().padStart(2, '0')}:${minutosRestantes.toString().padStart(2, '0')}`;
    }

    // Função para voltar ao formulário de cadastro
    function voltarParaCadastro() {
        if (containerCadastro && containerEdicao) {
            containerEdicao.style.display = 'none';
            containerCadastro.style.display = 'block';
            containerCadastro.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Configura os botões de edição
    if (botoesEditar.length > 0) {
        botoesEditar.forEach(botao => {
            botao.addEventListener('click', function() {
                const itemServico = this.closest('.item');
                if (!itemServico) return;
                
                // Obtém os dados do serviço do DOM
                const dadosServico = {
                    id: itemServico.dataset.id || '',
                    nome: itemServico.querySelector('h1')?.textContent.trim() || '',
                    valor: itemServico.querySelector('.preco p')?.textContent.trim() || '0',
                    duracao: itemServico.querySelector('.duracao')?.textContent.trim() || '0 min',
                    imagem: itemServico.querySelector('img')?.getAttribute('src') || ''
                };
                
                console.log('Dados do serviço para edição:', dadosServico); // Log para debug
                mostrarFormEdicao(dadosServico);
            });
        });
    }

    // Configura o botão de cancelar
    if (botaoCancelarEdicao) {
        botaoCancelarEdicao.addEventListener('click', voltarParaCadastro);
    }

    // Função para configurar a pré-visualização de imagens
    function configurarPreviewImagem(inputElement, previewElement) {
        if (!inputElement || !previewElement) return;
        
        inputElement.addEventListener('change', function(event) {
            const arquivo = event.target.files[0];
            if (!arquivo) return;

            const leitor = new FileReader();
            leitor.onload = function(e) {
                previewElement.src = e.target.result;
                previewElement.style.display = 'block';
                
                // Marca a imagem como alterada no formulário de edição
                if (previewElement.id === 'preview-edicao') {
                    previewElement.dataset.changed = 'true';
                }
            };
            leitor.readAsDataURL(arquivo);
        });
    }

    // Inicializa as pré-visualizações de imagem
    configurarPreviewImagem(inputFileCadastro, previewCadastro);
    configurarPreviewImagem(inputFileEdicao, previewEdicao);

    // Debug: Log quando o script é carregado com sucesso
    console.log('Script de atualização de serviços carregado com sucesso');
});