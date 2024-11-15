import React, { useEffect, useState } from 'react'
import { Children } from 'react'
import { Navigate } from 'react-router-dom'
import api from '../api/api'
import { ID } from '../api/constants'

function ProtectedRoute({ children }) {
  const [isAuthorized, setAuthorized] = useState(true)
  const id = localStorage.getItem(ID)

  useEffect(() => {
    verify()
  }, [])
  
  const verify = () => {
    api
    .post("/verify", { id : id })
    .then(res => {
      if(res.data === false){
        setAuthorized(false)
      } else {
        setAuthorized(true)
      }
    })
  }

  return isAuthorized ? children : <Navigate to={"/login"} />
}

export default ProtectedRoute