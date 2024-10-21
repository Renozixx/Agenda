import React, { useEffect, useState } from 'react'
import api from '../api'
import MyHeader from '../components/MyHeader'

const Teste = () => {
    const [req, setReq] = useState("")

    useEffect(() => {
      testandoAPI()
    })

    const testandoAPI = () => {
      api
      .get("/teste")
      .then(res => console.log(res))
      .catch(err => console.log(err))
    }
  
    return (
    <>

    </>
  )
}

export default Teste