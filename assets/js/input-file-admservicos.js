// document.getElementById('selecao-arquivo').addEventListener('change', function(e) {
//     const arquivo = e.target.files[0];
//     const nomeArquivoElement = document.getElementById('nome-arquivo');
//     const previewImagem = document.getElementById('preview-imagem');

//     if (arquivo) {
//         // Mostrar nome do arquivo
//         const nome = arquivo.name;
//         const nomeExibicao = nome.length > 20
//             ? nome.substring(0, 20) + '...' + nome.split('.').pop()
//             : nome;
//         nomeArquivoElement.textContent = nomeExibicao;
//         nomeArquivoElement.style.color = '#D3FAE0';

//         // Mostrar preview da imagem
//         const urlImagem = URL.createObjectURL(arquivo);
//         previewImagem.src = urlImagem;
//         previewImagem.style.display = 'block';
//     } else {
//         nomeArquivoElement.textContent = 'Nenhum arquivo selecionado';
//         nomeArquivoElement.style.color = '#555';
//         previewImagem.style.display = 'none';
//         previewImagem.src = '';
//     }
// });
