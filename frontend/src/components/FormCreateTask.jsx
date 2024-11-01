import React, {useState} from "react";
import api from "../api/api.js"
import qs from "qs"

const FormCreateTask = ({hid, hidden}) => {

  const [title, setTitle] = useState("")
  const [desc, setDesc] = useState("")
  const [date, setDate] = useState("")
  const [time, setTime] = useState("")

  const formSubmit = (e) => {
    e.preventDefault()
    api.post("/createTask", qs.stringify({
      title: title,
      desc: desc,
      date: date,
      time: time,
    })).then(response => {
      console.log(response)
    }).catch(error => {
      console.log("Erro: "+error)
    })
  }
  
  return (
    <>
      <form onSubmit={formSubmit} className={`flex flex-col items-end gap-1 w-80 ${hidden ? "hidden" : ""} top-1/2 left-1/2 translate-xy-1/2n absolute`}>

        <div onClick={() => hid(true)} className="p-1 bg-red-700 rounded-lg cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fff" viewBox="0 0 256 256"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
        </div>

        <div className="flex flex-col w-full">
          <label className="text-white" htmlFor="">Titulo</label>
          <input onChange={(e) => setTitle(e.target.value)} className="w-full h-11 p-1 border-0 focus:outline-none rounded-lg" placeholder="Título" type="text" name="title" id="" />
        </div>

        <div className="flex flex-col w-full">
          <label className="text-white" htmlFor="">Descrição</label>
          <textarea onChange={(e) => setDesc(e.target.value)} className="w-full h-24 p-1 border-0 focus:outline-none rounded-lg" placeholder="Descrição" name="desc" id=""></textarea>
        </div>

        <div className="flex flex-col w-full">
          <label className="text-white" htmlFor="">Data</label>
          <input onChange={(e) => setDate(e.target.value)} className="w-full h-11 p-1 border-0 focus:outline-none rounded-lg" placeholder="Data" type="date" name="date" id="" />
        </div>

        <div className="flex flex-col w-full">
          <label className="text-white" htmlFor="">Hora</label>
          <input onChange={(e) => setTime(e.target.value)} className="w-full h-11 p-1 border-0 focus:outline-none rounded-lg" placeholder="Hora" type="time" name="time" id="" />
        </div>

        <button className={`w-max p-2 px-6 mt-3 bg-blue-700 text-white rounded-lg`} type="submit">Criar</button>

      </form>
    </>
  )
}

export default FormCreateTask