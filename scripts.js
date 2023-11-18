
        function gerarCalendario() {
            // Código do calendário permanece igual

            // Requisição AJAX para buscar eventos do banco de dados
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    const eventos = JSON.parse(this.responseText);
                    console.log(eventos); // Aqui você terá os eventos, pode processá-los como necessário

                    // Exemplo de exibição dos eventos no console
                    eventos.forEach(function (evento) {
                        console.log(evento.data, evento.nome, evento.horario, evento.descricao);
                    });
                }
            };
            xhr.open('GET', 'buscar_eventos.php', true);
            xhr.send();
        }

        function exibirDetalhesEvento(dia) {
            const popup = document.getElementById('popup');
            popup.style.display = 'block';

            const dataEvento = `${dia}/${new Date().getMonth() + 1}/${new Date().getFullYear()}`;
            const nomeEvento = 'Nome do Evento'; // Substitua isso pelo nome real do evento associado a este dia
            const horarioEvento = 'HH:MM'; // Substitua isso pelo horário real do evento associado a este dia
            const descricaoEvento = 'Descrição do Evento'; // Substitua isso pela descrição real do evento associado a este dia

            document.getElementById('dataEvento').textContent = dataEvento;
            document.getElementById('nomeEvento').textContent = nomeEvento;
            document.getElementById('horarioEvento').textContent = horarioEvento;
            document.getElementById('descricaoEvento').textContent = descricaoEvento;
        }

        function fecharPopup() {
            const popup = document.getElementById('popup');
            popup.style.display = 'none';
        }

        gerarCalendario();
