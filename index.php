<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Use.me</title>
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
        <a href="perfil">Perfil</a>
        <a href="login">Login</a>
        <a href="compromissos">Compromissos</a>
    </nav>

    <div class="conteudo">
        <h1>USE.me</h1>
        <p>Use.me é um site que te ajuda a organizar sua vida</p>
    </div>

    <div class="calendario">
        <div class="mes">
            <h2 id="mes"></h2>
        </div>

        <div class="dias-semana">
            <!-- Aqui serão gerados os dias da semana 
        Domingo, Segunda-feira, Terça-feira, Quarta-feira, Quinta-feira, Sexta-feira, Sábado-->
        </div>

        <div class="calendario-dias" id="calendario-dias">
            <!-- Aqui serão gerados os dias do mês -->
        </div>
    </div>

    <div id="eventos-proximos">
        <h2>Eventos Futuros</h2>
        <?php
        include 'conexao.php';
        
        // Consulta para obter todos os eventos futuros ordenados por data
        $query = "SELECT * FROM eventos";
        $resultado = $conn->query($query);

        if ($resultado->num_rows > 0) {
            // Exibir os resultados em uma lista
            echo "<ul>";
            while ($row = $resultado->fetch_assoc()) {
                echo "<li><strong>Data:</strong> " . $row['data'] . " | <strong>Nome do Evento:</strong> " . $row['nome_evento'] . " | <strong>Horário:</strong> " . $row['horario'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Nenhum evento futuro encontrado.";
        }

        $conn->close();
        ?>
    </div>

    <div class="popup">
        <div class="popup-header">
            <h2>Evento</h2>
            <span class="close-button" onclick="fecharPopup()">&#10006;</span>
        </div>
        <form action="process.php" method="POST">
            <label for="evento">Nome do Evento:</label>
            <input type="text" id="evento" name="evento" required>

            <label for="horario">Horário:</label>
            <input type="time" id="horario" name="horario" required>

            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required></textarea>

            <label for="acao">Ação:</label>
            <select id="acao" name="acao" required>
                <option value="criar">Criar</option>
                <option value="editar">Editar</option>
                <option value="excluir">Excluir</option>
            </select>

            <button type="submit">Confirmar</button>
        </form>
    </div>

    <script>
        function gerarCalendario() {
            const diasNoMes = 31; // Defina o número de dias no mês atual

            const mesAtual = new Date().toLocaleString('pt-br', { month: 'long' });
            document.getElementById('mes').textContent = mesAtual;

            const diasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

            const calendarioDias = document.getElementById('calendario-dias');

            for (let i = 0; i < diasSemana.length; i++) {
                const diaSemana = document.createElement('div');
                diaSemana.classList.add('dia-semana');
                diaSemana.textContent = diasSemana[i];
                calendarioDias.appendChild(diaSemana);
            }

            for (let dia = 1; dia <= diasNoMes; dia++) {
                const diaElemento = document.createElement('div');
                diaElemento.classList.add('dia');
                diaElemento.textContent = dia;

                diaElemento.addEventListener('click', exibirPopup);
                calendarioDias.appendChild(diaElemento);
            }
        }

        function exibirPopup() {
            const popup = document.querySelector('.popup');
            popup.style.display = 'block';

            const eventoInput = document.querySelector('#evento');
            const descricaoInput = document.querySelector('#descricao');
            const horarioInput = document.querySelector('#horario');
            const diaSelecionado = this.textContent;

            eventoInput.value = '';
            descricaoInput.value = '';
            horarioInput.value = '';
        }

        function fecharPopup() {
            const popup = document.querySelector('.popup');
            popup.style.display = 'none';
        }

        gerarCalendario();
    </script>
</body>

</html>
