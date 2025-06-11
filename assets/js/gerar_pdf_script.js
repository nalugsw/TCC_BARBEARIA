// relatorios.js

// Função para formatar data
function formatarData(data) {
    const date = new Date(data);
    return date.toLocaleDateString('pt-BR') + ' ' + date.toLocaleTimeString('pt-BR');
}

// Função para formatar valor monetário
function formatarMoeda(valor) {
    return 'R$ ' + parseFloat(valor).toFixed(2).replace('.', ',');
}

// Função para gerar PDF
function gerarPDF() {
    // Carregar a biblioteca jsPDF dinamicamente
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
    script.onload = function() {
        const { jsPDF } = window.jspdf;
        
        // Criar novo documento PDF
        const doc = new jsPDF({
            orientation: 'portrait',
            unit: 'mm'
        });

        // Adicionar título
        doc.setFontSize(18);
        doc.text('Relatório de Atendimentos', 105, 15, { align: 'center' });
        
        // Adicionar período
        const periodoLabel = document.querySelector('.estatistica-item strong').textContent;
        doc.setFontSize(12);
        doc.text(`Período: ${periodoLabel}`, 14, 25);
        
        // Adicionar estatísticas
        const estatisticas = document.querySelectorAll('.estatistica-item');
        let yPos = 35;
        
        estatisticas.forEach((estatistica, index) => {
            if (index > 0) { // Pular o primeiro item que já usamos (período)
                const label = estatistica.querySelector('span').textContent;
                const value = estatistica.querySelector('strong').textContent;
                doc.text(`${label} ${value}`, 14, yPos);
                yPos += 7;
            }
        });
        
        yPos += 5;
        
        // Adicionar tabela de atendimentos
        doc.setFontSize(14);
        doc.text('Detalhes dos Atendimentos', 14, yPos);
        yPos += 10;
        
        // Configurar cabeçalho da tabela
        const headers = ['Data', 'Serviço', 'Valor', 'Cliente'];
        const columnWidths = [40, 60, 30, 60];
        
        // Adicionar cabeçalho
        doc.setFontSize(12);
        doc.setFont(undefined, 'bold');
        headers.forEach((header, i) => {
            doc.text(header, 14 + columnWidths.slice(0, i).reduce((a, b) => a + b, 0), yPos);
        });
        yPos += 7;
        
        // Adicionar linhas da tabela
        doc.setFont(undefined, 'normal');
        const rows = document.querySelectorAll('#tabelaRelatorio tbody tr');
        
        rows.forEach(row => {
            // Verificar se é a linha "sem registros"
            if (row.querySelector('.sem-registros')) {
                doc.text(row.querySelector('.sem-registros').textContent, 14, yPos);
                yPos += 7;
                return;
            }
            
            const cells = row.querySelectorAll('td');
            let xPos = 14;
            
            cells.forEach((cell, i) => {
                doc.text(cell.textContent, xPos, yPos);
                xPos += columnWidths[i];
            });
            
            yPos += 7;
            
            // Verificar se precisa de nova página
            if (yPos > 270) {
                doc.addPage();
                yPos = 20;
                
                // Adicionar cabeçalho novamente
                doc.setFontSize(12);
                doc.setFont(undefined, 'bold');
                headers.forEach((header, i) => {
                    doc.text(header, 14 + columnWidths.slice(0, i).reduce((a, b) => a + b, 0), yPos);
                });
                yPos += 7;
                doc.setFont(undefined, 'normal');
            }
        });
        
        // Adicionar gráficos como imagens (simplificado - na prática precisaria converter canvas para imagem)
        // Nota: Esta parte requer implementação adicional para converter os gráficos em imagens
        
        // Salvar o PDF
        doc.save(`relatorio_atendimentos_${new Date().toISOString().slice(0,10)}.pdf`);
    };
    document.head.appendChild(script);
}

function gerarExcel() {
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js';
    script.onload = function() {
        try {
            // Criar workbook com apenas a tabela de atendimentos
            const table = document.getElementById('tabelaRelatorio');
            const wb = XLSX.utils.table_to_book(table);
            
            // Baixar o arquivo
            XLSX.writeFile(wb, 'relatorio_atendimentos.xlsx');
        } catch (error) {
            console.error('Erro ao gerar Excel:', error);
            alert('Erro ao gerar Excel. Verifique o console para detalhes.');
        }
    };
    document.head.appendChild(script);
}

// Adicionar eventos aos botões
document.addEventListener('DOMContentLoaded', function() {
    // Verificar se os botões existem (para evitar erros se o script for carregado em outra página)
    const btnPDF = document.querySelector('.btn-download:nth-of-type(1)');
    const btnExcel = document.querySelector('.btn-download:nth-of-type(2)');
    
    if (btnPDF) btnPDF.addEventListener('click', gerarPDF);
    if (btnExcel) btnExcel.addEventListener('click', gerarExcel);
});