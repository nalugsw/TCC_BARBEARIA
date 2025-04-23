document.addEventListener('DOMContentLoaded', function() {
    // Variáveis globais
    let selectedDate = null;
    const calendarEl = document.getElementById('calendar');
    const timeSlotsEl = document.getElementById('time-slots');
    const timesContainer = document.getElementById('times-container');
    const selectedDateEl = document.getElementById('selected-date');
    const bookingForm = document.getElementById('booking-form');
    const appointmentForm = document.getElementById('appointment-form');
    const confirmationEl = document.getElementById('confirmation');
    const confirmationDetails = document.getElementById('confirmation-details');
    
    // Gerar calendário
    function generateCalendar() {
        
        const today = new Date();
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();
        
        // Criar meses (pode expandir para mais meses)
        for (let m = 0; m < 3; m++) {
            const monthDate = new Date(currentYear, currentMonth + m, 1);
            const monthName = monthDate.toLocaleString('pt-BR', { month: 'long' });
            const year = monthDate.getFullYear();
            
            const monthEl = document.createElement('div');
            monthEl.className = 'month';
            
            const monthNameEl = document.createElement('div');
            monthNameEl.className = 'month-name';
            monthNameEl.textContent = `${monthName.charAt(0).toUpperCase() + monthName.slice(1)} ${year}`;
            
            const daysEl = document.createElement('div');
            daysEl.className = 'days';
            
            // Cabeçalhos dos dias da semana
            const dayNames = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
            dayNames.forEach((day, index) => {
                const dayHeader = document.createElement('div');
                dayHeader.className = 'day-header';
                dayHeader.textContent = day;
                
                // Destacar o cabeçalho de domingo
                if (index === 0) {
                    dayHeader.style.color = '#c62828';
                }
                
                daysEl.appendChild(dayHeader);
            });
            
            // Dias do mês
            const firstDay = new Date(year, monthDate.getMonth(), 1).getDay();
            const daysInMonth = new Date(year, monthDate.getMonth() + 1, 0).getDate();
            
            // Dias vazios no início
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'day empty';
                daysEl.appendChild(emptyDay);
            }
            
            // Dias do mês
            for (let d = 1; d <= daysInMonth; d++) {
                const dayEl = document.createElement('div');
                const dayDate = new Date(year, monthDate.getMonth(), d);
                const dayOfWeek = dayDate.getDay(); // 0 = Domingo, 1 = Segunda, etc.
                
                dayEl.className = 'day';
                dayEl.textContent = d;
                
                const dateStr = `${year}-${String(monthDate.getMonth() + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}T12:00:00`;
                
                // Verificar se é domingo OU se é um dia passado
                if (dayOfWeek === 0) {
                    // Domingo - não clicável
                    dayEl.classList.add('sunday', 'unavailable');
                    dayEl.style.cursor = 'not-allowed';
                    dayEl.title = "Não abrimos aos domingos";
                    
                    // Prevenir qualquer ação de clique
                    dayEl.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    });
                } else if (dayDate < today && dayDate.toDateString() !== today.toDateString()) {
                    // Dias passados - não clicável
                    dayEl.classList.add('past-day', 'unavailable');
                    dayEl.style.cursor = 'not-allowed';
                    dayEl.title = "Data passada";
                    
                    // Prevenir qualquer ação de clique
                    dayEl.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    });
                } else {
                    // Dias disponíveis - adicionar evento de clique
                    dayEl.addEventListener('click', function() {
                        selectDate(this);
                    });
                }
                
                daysEl.appendChild(dayEl);
            }
            
            monthEl.appendChild(monthNameEl);
            monthEl.appendChild(daysEl);
            calendarEl.appendChild(monthEl);
        }
    }
    
    // Selecionar data
    function selectDate(dayEl) {
        // Remover seleção anterior
        const previouslySelected = document.querySelector('.day.selected');
        if (previouslySelected) {
            previouslySelected.classList.remove('selected');
        }
        
        // Adicionar seleção atual
        dayEl.classList.add('selected');
        selectedDate = dayEl.dataset.date;
        selectedDateEl.textContent = formatDate(selectedDate);
        
        // Mostrar container de horários
        timeSlotsEl.style.display = 'block';
        bookingForm.style.display = 'none';
        
        // Carregar horários disponíveis
        loadTimeSlots(selectedDate);
    }
    
    // Formatar data para exibição
    function formatDate(dateStr) {
        // Corrige o problema do fuso horário adicionando o 'T12:00:00'
        const date = new Date(dateStr + 'T12:00:00');
        return date.toLocaleDateString('pt-BR', { 
            weekday: 'long', 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric',
            timeZone: 'America/Sao_Paulo' // Especifica o fuso horário
        });
    }
    
    // Carregar horários disponíveis via AJAX
    function loadTimeSlots(date) {
        timesContainer.innerHTML = '<p>Carregando horários...</p>';
        
        fetch(`horarios.php?date=${date}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Dados recebidos:', data);
                
                if (data.error) {
                    timesContainer.innerHTML = `<p>Erro: ${data.error}</p>`;
                    return;
                }
                
                timesContainer.innerHTML = '';
                
                if (data.length === 0) {
                    timesContainer.innerHTML = '<p>Nenhum horário disponível para esta data.</p>';
                    return;
                }
                
                data.forEach(time => {
                    const timeSlot = document.createElement('div');
                    timeSlot.className = 'time-slot';
                    timeSlot.textContent = time.hora;
                    timeSlot.dataset.time = time.hora;
                    
                    if (time.status === 'reservado') {
                        timeSlot.classList.add('booked');
                        timeSlot.title = "Este horário já está reservado";
                    } else {
                        timeSlot.addEventListener('click', function() {
                            selectTimeSlot(this);
                        });
                    }
                    
                    timesContainer.appendChild(timeSlot);
                });
            })
            .catch(error => {
                console.error('Erro completo:', error);
                timesContainer.innerHTML = `<p>Erro ao carregar horários: ${error.message}</p>`;
            });
    }
    
    // Selecionar horário
    function selectTimeSlot(timeSlotEl) {
        // Remover seleção anterior
        const previouslySelected = document.querySelector('.time-slot.selected');
        if (previouslySelected) {
            previouslySelected.classList.remove('selected');
        }
        
        // Adicionar seleção atual
        timeSlotEl.classList.add('selected');
        
        // Preencher formulário
        document.getElementById('selected-time').value = timeSlotEl.dataset.time;
        document.getElementById('selected-full-date').value = selectedDate;
        
        // Mostrar formulário
        bookingForm.style.display = 'block';
    }
    
    // Enviar formulário de agendamento
    appointmentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Validar campos antes de enviar
        const name = formData.get('name');
        const email = formData.get('email');
        
        if (!name || !email) {
            alert('Por favor, preencha todos os campos.');
            return;
        }
        
        if (!validateEmail(email)) {
            alert('Por favor, insira um e-mail válido.');
            return;
        }
        
        fetch('processa.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Mostrar confirmação
                timeSlotsEl.style.display = 'none';
                bookingForm.style.display = 'none';
                confirmationEl.style.display = 'block';
                
                const formattedDate = formatDate(selectedDate);
                confirmationDetails.textContent = `Você agendou para ${formattedDate} às ${data.time}. Um e-mail de confirmação foi enviado para ${email}.`;
                
                // Resetar o formulário
                appointmentForm.reset();
            } else {
                alert('Erro ao agendar: ' + (data.message || 'Erro desconhecido'));
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao enviar agendamento. Tente novamente.');
        });
    });
    
    // Validar e-mail
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Inicializar calendário
    generateCalendar();
});