document.getElementById('selecao-arquivo').addEventListener('change', function(e) {
    var fileName = e.target.files[0]?.name || 'Nenhum arquivo selecionado';
    console.log('Arquivo selecionado:', fileName);
    // Você pode exibir o nome em algum elemento se quiser
});

document.getElementById('selecao-arquivo').addEventListener('change', function(e) {
    const nomeArquivoElement = document.getElementById('nome-arquivo');
    if (this.files.length > 0) {
        // Mostra o nome do arquivo (limitando a 20 caracteres + extensão)
        const nome = this.files[0].name;
        const nomeExibicao = nome.length > 20 
            ? nome.substring(0, 20) + '...' + nome.split('.').pop() 
            : nome;
        nomeArquivoElement.textContent = nomeExibicao;
        nomeArquivoElement.style.color = '#D3FAE0';
    } else {
        nomeArquivoElement.textContent = 'Nenhum arquivo selecionado';
        nomeArquivoElement.style.color = '#555';
    }
});