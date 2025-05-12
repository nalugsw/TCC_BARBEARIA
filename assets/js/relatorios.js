function atualizarRelatorio() {
    const filtro = document.getElementById('filtroPeriodo').value;
  
    // Simulação de dados conforme o filtro (os dados reais virão do PHP/SQL)
    let dados = [];
  
    switch (filtro) {
      case 'ultimaSemana':
        dados = [
          { data: '2025-05-01', servico: 'Corte', valor: 'R$ 50,00', cliente: 'João' },
          { data: '2025-05-02', servico: 'Barba', valor: 'R$ 30,00', cliente: 'Maria' }
        ];
        break;
      case 'ultimoMes':
        dados = [
          { data: '2025-04-15', servico: 'Corte', valor: 'R$ 50,00', cliente: 'Carlos' },
          { data: '2025-04-20', servico: 'Barba', valor: 'R$ 30,00', cliente: 'Ana' }
        ];
        break;
      case 'ultimoSemestre':
        dados = [
          { data: '2024-11-10', servico: 'Corte', valor: 'R$ 50,00', cliente: 'Lucas' },
          { data: '2024-12-10', servico: 'Barba', valor: 'R$ 30,00', cliente: 'Fernanda' }
        ];
        break;
      case 'ultimoAno':
        dados = [
          { data: '2024-01-15', servico: 'Corte', valor: 'R$ 50,00', cliente: 'Roberto' },
          { data: '2024-03-21', servico: 'Barba', valor: 'R$ 30,00', cliente: 'Julia' }
        ];
        break;
    }
  
    // Atualizar a tabela com os dados
    const tabela = document.getElementById('tabelaRelatorio').getElementsByTagName('tbody')[0];
    tabela.innerHTML = ''; // Limpar a tabela antes de adicionar novos dados
  
    dados.forEach(dado => {
      const linha = tabela.insertRow();
      linha.innerHTML = `
        <td>${dado.data}</td>
        <td>${dado.servico}</td>
        <td>${dado.valor}</td>
        <td>${dado.cliente}</td>
      `;
    });
  }
  
  // Chamar a função inicialmente para carregar os dados do filtro padrão
  atualizarRelatorio();
  