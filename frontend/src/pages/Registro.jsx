import React, { useEffect, useState } from 'react'
import Aside from '../components/Aside'
import MyHeader from '../components/MyHeader'
import FormRegistro from '../components/FormRegistro.jsx'
import api from '../api/api.js'
import qs from 'qs'

function Registro() {
  const [nome, setNome] = useState("")
  const [email, setEmail] = useState("")
  const [password, setPassword] = useState("")
  const [telefone, setTelefone] = useState("")
  const [user, setUser] = useState(false)
  
  const formSubmit = (e) => {
    e.preventDefault()

    api
    .post('/register', qs.stringify(
      { 
        nome: nome,
        email : email,
        password: password,
        telefone: telefone,
      })
    )
    .then(res => {
      setUser(res.data)
      console.log(user)
    })
    .catch(err => console.log(err))
  }

  return (
    <>
      <main className='flex'>
        {user}
        <MyHeader></MyHeader>
        <div className='mt-20 flex justify-center items-center w-full'>
          <div className='lg:w-1/3 md:w-2/3 sm:w-4/5 h-full'>
            <FormRegistro envio={formSubmit}></FormRegistro>
          </div>
        </div>
      </main>
    </>    
  )
}

export default Registro