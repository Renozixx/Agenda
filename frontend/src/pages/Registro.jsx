import React, { useEffect, useState } from 'react'
import Aside from '../components/Aside'
import MyHeader from '../components/MyHeader'
import api from '../api.js'
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
            <form onSubmit={formSubmit} className='form-container p-8 rounded-lg shadow-sm shadow-black w-full text-white 
            text-xl'>
              <h1 className='text-2xl mb-4 text-center'>Registro</h1>
              <div>
                <label htmlFor="Nome" className='block font-semibold mt-5'>Nome</label>
                <br />
                <input 
                  type="text"
                  value={nome}
                  onChange={(e) => setNome(e.target.value)}
                  placeholder='Nome'
                  className='w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2
                  focus:ring-blue-500 text-black'
                />
              </div>
              <div className=''>
                <label htmlFor="Email" className='block font-semibold'>Email</label>
                <br />
                <input 
                  type="mail" 
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  placeholder='Email'
                  className='w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2
                  focus:ring-blue-500 text-black'
                />
              </div>
              <div>
                <label htmlFor="Password" className='block font-semibold mt-5'>Senha</label>
                <br />
                <input 
                  type="password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  placeholder='Senha'
                  className='w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2
                  focus:ring-blue-500 text-black'
                />
              </div>
              <div>
                <label htmlFor="Telefone" className='block font-semibold mt-5'>Telefone</label>
                <br />
                <input 
                  type="number"
                  value={telefone}
                  onChange={(e) => setTelefone(e.target.value)}
                  placeholder='Telefone'
                  className='w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2
                  focus:ring-blue-500 text-black'
                />
              </div>
              <div className='flex justify-center'>
                <button onClick={formSubmit} className='bg-blue-700 px-8 py-3 mt-5 self-center rounded-md'>
                  Cadastrar
                </button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </>    
  )
}

export default Registro