import React, { useEffect } from 'react'
import MyHeader from '../components/MyHeader'
import Aside from '../components/Aside'
import api from '../api/api.js'
const Home = () => {

    return (  
        <>
            <MyHeader />
            <Aside></Aside>
            <h1>Home</h1>
        </>
    )
}

export default Home