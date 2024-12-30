document.addEventListener("DOMContentLoaded", () => {
    // Obtém o botão de alternância e o ícone do Dark Mode
    const toggleButton = document.getElementById("dark-mode-toggle");
    const darkModeIcon = document.getElementById("dark-mode-icon");

    // Checa o estado do Dark Mode no localStorage
    const isDarkModeEnabled = localStorage.getItem("dark-mode") === "enabled";

    // Função para atualizar o ícone do Dark Mode baseado no estado atual
    function updateDarkMode() {
        if (document.body.classList.contains("dark-mode")) {
            darkModeIcon.textContent = "🌞"; // Modo claro (ícone de sol)
        } else {
            darkModeIcon.textContent = "🌙"; // Modo escuro (ícone de lua)
        }
    }

    // Se o Dark Mode estiver ativado, aplica a classe 'dark-mode' ao body
    if (isDarkModeEnabled) {
        document.body.classList.add("dark-mode");
    }

    // Atualiza o ícone inicial baseado no estado do tema
    updateDarkMode();

    // Evento de clique para alternar entre os modos
    toggleButton.addEventListener("click", () => {
        // Alterna a classe 'dark-mode' no body
        document.body.classList.toggle("dark-mode");

        // Atualiza o ícone conforme o novo estado do tema
        updateDarkMode();

        // Salva a preferência do usuário no localStorage
        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("dark-mode", "enabled");
        } else {
            localStorage.removeItem("dark-mode");
        }
    });
});
