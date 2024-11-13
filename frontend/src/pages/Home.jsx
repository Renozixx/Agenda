import React from "react";
import MyHeader from "../components/MyHeader";
import api from "../api/api";
import Aside from "../components/Aside";
import { ID } from "../api/constants";
import ProtectedRoute from "../components/ProtectedRoute";

const Teams = () => {
  const id = localStorage.getItem(ID)
  
  

  return (
    <ProtectedRoute>
      <MyHeader/>
      <main className={`min-h-screen pt-16 p-4 transition-all duration-200`}>
        <div className="boxTasks flex gap-3 w-fill overflow-auto scroll-bg-dark scroll-btn-none">
        </div>
      </main>
      <Aside></Aside>
    </ProtectedRoute>
  )
}

export default Teams;
