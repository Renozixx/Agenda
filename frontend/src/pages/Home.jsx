import React, { useEffect } from 'react'
import MyHeader from '../components/MyHeader'
import Aside from '../components/Aside'
import api from '../api'
const Home = () => {

    useEffect(() => {
        getRoute()
    })

    const getRoute = () => {
        api.
        get("Request.php?route=login")
        .then(res => console.log(res))
        .catch(err => {
            console.log(err)
            if(err.response) {
                console.error("Dados do erro:", err.response.data)
                console.error("Status do erro:", err.response.status)
            }
        })
    }

    return (  
        <>
            <MyHeader />
            <Aside></Aside>
            <h1>Home</h1>
        </>
    )
}

export default Home