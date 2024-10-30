import React, { useEffect, useState } from 'react'
import MyHeader from '../components/MyHeader'
import Aside from '../components/Aside'
import CardTask from '../components/CardsTask.jsx'
import CardAddTask from "../components/CardAddTask.jsx"
import api from '../api/api.js'
import qs from "qs"
import { json } from 'react-router-dom'
const Home = () => {

  const [tasks, setTasks] = useState([]);
  const [isExpanded, setIsExpanded] = useState(true);

  useEffect(() => {
    api.post("/requestTasks", qs.stringify({}))
      .then(response => {
          setTasks(response.data); // Decodificando JSON para verificar a resposta)
      })
      .catch(error => {
          console.error("Erro ao fazer a requisição:", error); // Tratando erro
      });
  }, []);

  const updateTasks = (Expanded) => { // Recebendo o estado do Aside
    setIsExpanded(Expanded)
  }

  return (
    <>
      <MyHeader/>
      <main className={`min-h-screen ${isExpanded ? "ml-16" : "ml-64"} pt-16 p-4 transition-all duration-200`}>
        <div className="boxTasks flex gap-3 w-fill overflow-auto scroll-bg-dark scroll-btn-none">
          {tasks.map((task, index) => (
            <CardTask key={index} props={task} />
          ))}
            <CardAddTask/>
        </div>
      </main>
      <Aside onToggle={updateTasks}></Aside>
    </>
  )
}

export default Home
