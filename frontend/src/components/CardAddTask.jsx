import Reack, {useEffect, useState} from "react"
import FormCreateTask from "../components/FormCreateTask.jsx"

const CardAddTask = () => {
  
  const [hidden, setHidden] = useState(true)
  
  return (
    <>
      <div onClick={() => setHidden(false)} className="flex flex-wrap justify-center items-center gap-1 min-w-80 w-80 min-h-40 h-max p-2 text-white bg-slate-800 bg-opacity-50 rounded-md cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffffff" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path></svg>
      </div>
      <FormCreateTask hid={setHidden} hidden={hidden}></FormCreateTask>
      </>
  )

}

export default CardAddTask