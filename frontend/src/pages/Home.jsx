import React, { useEffect, useState } from 'react'
import MyHeader from '../components/MyHeader'
import Aside from '../components/Aside'
import api from '../api/api.js'
import qs from "qs"
const Home = () => {

  const [tasks, setTasks] = useState("");

  const tarefas = () => {
    api.post("/requestTasks", qs.stringify({}))
        .then(response => {
            setTasks(response.data); // Adicionando log para verificar a resposta
        })
        .catch(error => {
            console.error("Erro ao fazer a requisição:", error); // Tratando erro
        });
  }

  return (  
    <>
      <MyHeader />
      <Aside></Aside>
      <button onClick={tarefas} className="bg-blue-700 px-8 py-3 mt-5 self-center rounded-md">Enviar</button>
      {tasks}
    </>
  )
}

export default Home
