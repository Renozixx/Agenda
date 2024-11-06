import React, { useEffect, useState } from 'react'
import MyHeader from '../components/MyHeader.jsx'
import Aside from '../components/Aside.jsx'
import CardTask from '../components/CardsTask.jsx'
import CardAddTask from "../components/CardAddTask.jsx"
import api from '../api/api.js'
import qs from "qs"
import { json } from 'react-router-dom'
const Home = () => {

  const [tasks, setTasks] = useState([]);
  const [isExpanded, setIsExpanded] = useState(true);
  const [month, setMonth] = useState("");
  const [year, setYear] = useState("");
  const [monthHidden, setMonthHidden] = useState(true)

  useEffect(() => {
    api.post("/requestPersonal", qs.stringify({}))
      .then(response => {
        setTasks(response.data[0]); // Decodificando JSON para verificar a resposta)
        setYear(response.data[1]);
        setMonth(response.data[2]);
      })
      .catch(error => {
        console.error("Erro ao fazer a requisição:", error); // Tratando erro
      });
  }, []);

  const destroyMonth = () => {
    setMonth(".");
  }

  const visibleMonth = () => {
    setMonthHidden(true);
  }

  const updateTasks = (Expanded) => { // Recebendo o estado do Aside
    setIsExpanded(Expanded)
  }

  year ? document.querySelector(".year").innerHTML = year : ""
  month ? document.querySelector(".pMonth").innerHTML = month : ""

  return (
    <>
      <MyHeader/>
      <main className={`flex flex-col min-h-screen ${isExpanded ? "ml-16" : "ml-64"} pt-16 p-4 transition-all duration-200`}>
        <div className="boxTasks flex gap-3 w-fill overflow-auto scroll-bg-dark scroll-btn-none">
          {tasks.map((task, index) => (
            <CardTask key={index} props={task} />
          ))}
          <CardAddTask/>
        </div>
        <div className="year grid-year gap-1 w-full p-3 m-auto"></div>
        <div className={`popup ${monthHidden ? "block" : "hidden"} w-3/4 h-3/4 border border-slate-400 text-white rounded fixed top-1/2 left-1/2 translate-xy-1/2n`}>
          <div className='icon p-1 bg-red-700 rounded fixed cursor-pointer top-0 right-0 translate-xy-1n/2' onClick={destroyMonth}> <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='#fff' viewBox='0 0 256 256'><path d='M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z'></path></svg></div>
          <div className="pMonth flex w-full h-full m-auto"></div>
        </div>
      </main>
      <Aside onToggle={updateTasks}></Aside>
    </>
  )
}

export default Home
