import React from 'react'
import { Link } from 'react-router-dom'

const MyHeader = () => {
  return (
    <>
        <header className="flex justify-center w-full p-3 fixed">
            <ul className="flex gap-2 text-white">
                <li><Link to={"/"}>Home</Link></li>
                <li><Link to={"/login"}>Login</Link></li>
                <li><Link to={"/registro"}>Registrar-se</Link></li>
            </ul>
        </header>
    </>
  )
}

export default MyHeader