import axios from "axios";

// Configurando a nossa API, como vamos usar o Axios, a configuração ficará assim

const api = axios.create({
    baseURL: 'http://localhost:8000/src/Request.php', // Essa é a URL base visando atingir as "Rotas"
    withCredentials: true, // Isso serve para os cookies
    headers: {
        "Content-Type": 'application/json',
    }
})

export default api