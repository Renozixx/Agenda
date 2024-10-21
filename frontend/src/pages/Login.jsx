import React, { useEffect, useState } from 'react'
import Aside from '../components/Aside'

function Login() {
  const [email, setEmail] = useState("")
  const [password, setPassword] = useState("")

  useEffect(() => {

  })
  
  const formSubmit = (e) => {
    e.preventDefault()


  }

  return (
    <>
      <main className='flex'>
        <MyHeader></MyHeader>
        <div className='mt-20 flex justify-center items-center w-full'>
          <div className=''>
            <form onSubmit={formSubmit} className='form-container p-8 rounded-lg shadow-md w-full text-white 
            text-xl'>
              <h1 className='text-2xl mb-4 text-center'>Login</h1>
              <div className=''>
                <label htmlFor="Email" className='block font-semibold'>Email</label>
                <br />
                <input 
                  type="text" 
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
            </form>
          </div>
        </div>
      </main>
    </>    
  )
}

export default Login