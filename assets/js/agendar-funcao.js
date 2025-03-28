// Encontrar a div 'horarios' dentro deste dia específico

// agendar-funcao.js
function toggleHorarios(btn) {
  const diaDiv = btn.closest('.dia');

  const horariosDiv = diaDiv.querySelector('.horarios');
  const icon = btn.querySelector('i');
  
  if (horariosDiv.style.display === 'none') {
      horariosDiv.style.display = 'block';
      btn.innerHTML = 'HORÁRIOS <i class="bi bi-caret-up-fill"></i>';
      
      // Fechar outros horários abertos
      document.querySelectorAll('.horarios').forEach(div => {
          if (div !== horariosDiv && div.style.display === 'block') {
              div.style.display = 'none';
              const otherBtn = div.closest('.dia').querySelector('.horarios-btn');
              otherBtn.innerHTML = 'HORÁRIOS <i class="bi bi-caret-down-fill"></i>';
          }
      });
  } else {
      horariosDiv.style.display = 'none';
      btn.innerHTML = 'HORÁRIOS <i class="bi bi-caret-down-fill"></i>';
  }
}

function selecionarHorario(btn) {
  const data = btn.getAttribute('data-data');
  const horario = btn.getAttribute('data-horario');
  const horarioFormatado = formatarHorario(horario);
  
  // Aqui você pode implementar a lógica para finalizar o agendamento
  if (confirm(`Confirmar agendamento para ${data} às ${horarioFormatado}?`)) {
      // Enviar dados para o servidor via AJAX
      agendarHorario(data, horario);
  }
}


function formatarHorario(horario) {
  const [hora, minuto] = horario.split(':');
  const periodo = hora < 12 ? 'AM' : 'PM';
  const hora12 = hora % 12 || 12;
  return `${hora12}:${minuto} ${periodo}`;
}

function agendarHorario(data, horario) {
  // Implementar AJAX para enviar o agendamento ao servidor
  fetch('processar_agendamento.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
      },
      body: JSON.stringify({
          data: data,
          horario: horario,
          id_servico: obterServicoSelecionado() // Implementar esta função
      })
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          alert('Agendamento realizado com sucesso!');
          // Atualizar a página ou a seção de agendamento
          window.location.reload();
      } else {
          alert('Erro ao agendar: ' + data.message);
      }
  })
  .catch(error => {
      console.error('Error:', error);
      alert('Erro ao processar agendamento');
  });
}

function showHorarios() {
  document.getElementById('grid3').style.display = 'grid';
  document.querySelector('.agenda').scrollIntoView({ behavior: 'smooth' });
}
