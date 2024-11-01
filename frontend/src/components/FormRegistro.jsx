import React from "react";

const FormRegistro = ({envio}) => {
  return (
    <>
      <form onSubmit={envio} className='form-container p-8 rounded-lg shadow-sm shadow-black w-full text-white 
      text-xl'>
        <h1 className='text-2xl mb-4 text-center'>Registro</h1>
          
        <fieldset className="flex flex-col gap-1">
          <div>
            <label htmlFor="Nome" className='block font-semibold'>Nome</label>
            <input type="text" onChange={(e) => setNome(e.target.value)} placeholder='Nome' className='w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black'/>
          </div>
          <div className=''>
            <label htmlFor="Email" className='block font-semibold'>Email</label>
            <input
              type="mail" onChange={(e) => setEmail(e.target.value)} placeholder='Email' className='w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black'/>
          </div>
          <div>
            <label htmlFor="Password" className='block font-semibold'>Senha</label>
            <input
              type="password" onChange={(e) => setPassword(e.target.value)} placeholder='Senha' className='w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black'/>
          </div>
          <div>
            <label htmlFor="Telefone" className='block font-semibold'>Telefone</label>
            <input
              type="number" onChange={(e) => setTelefone(e.target.value)} placeholder='Telefone' className='w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black'/>
          </div>
          <div className='flex justify-center'>
            <button onClick={envio} className='bg-blue-700 px-8 py-3 self-center rounded-md'>Cadastrar</button>
          </div>
        </fieldset>
      </form>
    </>
  ) 
}

export default FormRegistro