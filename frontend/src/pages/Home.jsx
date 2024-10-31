import React from "react";
import MyHeader from "../components/MyHeader";
import api from "../api/api";
import Aside from "../components/Aside";

const Teams = () => {
  return (
    <>
      <MyHeader/>
      <main className={`min-h-screen ${isExpanded ? "ml-16" : "ml-64"} pt-16 p-4 transition-all duration-200`}>
        <div className="boxTasks flex gap-3 w-fill overflow-auto scroll-bg-dark scroll-btn-none">
          {tasks.map((task, index) => (
            <CardTask key={index} props={task} />
          ))}
            <CardAddTask/>
        </div>
      </main>
      <Aside onToggle={updateTasks}></Aside>
    </>
  )
}

export default Teams;
