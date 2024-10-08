class Redirect {
    sendGET (url = "/", dados = [])
    {
        let newDados = ""
        dados.forEach(element => {
            newDados = newDados +"/"+ element
        });
        console.log(newDados)
        window.location.href = url + newDados
    }
}