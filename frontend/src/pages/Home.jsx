import React from "react";
import MyHeader from "../components/MyHeader";
import api from "../api/api";
import Aside from "../components/Aside";
import { ID } from "../api/constants";

const Teams = () => {
  const id = localStorage.getItem(ID)

  api.post('/verify', {
    id: id
  })
  .then(res => res.data)
  .then(data => console.log(data))
  .catch(err => console.log(err))

  return (
    <>
      <MyHeader/>
      <Aside></Aside>
    </>
  )
}

export default Teams;
