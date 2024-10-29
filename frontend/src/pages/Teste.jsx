import React, { useEffect, useState } from 'react'
import api from '../api/api'
import MyHeader from '../components/MyHeader'

const Teste = () => {
  const [counter, setCounter] = useState(0);

  const testandoAPI = () => {
    api
      .get("/teste")
      .then((res) => console.log(res))
      .catch((err) => console.log(err));
  };

  const mudandoCounter = () => {
    setCounter((counter+1))
  }

  const Teste = () => {
    console.log("Mostrando o uso do UseEffect")
  }

  useEffect(() => {
    testandoAPI();
  }, []);

  useEffect(() =>{
    Teste()
  }, [counter])

  return (
    <>
      <main className="text-white p-10">
        <p className="text-xl">{counter}</p>
        <button onClick={mudandoCounter} className="bg-gray-700 p-2 border-black">Adicionando valor no Counter</button>
      </main>
    </>
  );
};

export default Teste;
