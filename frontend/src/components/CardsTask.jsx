import React, {useEffect, useState} from "react"

const CardTask = ({props}) => {
  return (
    <>
      <div className="flex flex-wrap justify-center items-center gap-1 w-80 min-h-40 h-max p-2 text-white bg-slate-800 rounded-md">
        {/* <div className="">{props[0]}</div> */}
        <div className="w-full break-all">{props[1]}</div>
        <div className="w-full break-all">{props[2]}</div>
        <div className="dateTask flex items-end w-full break-all">
          <div className="w-50p">{props[3]}</div>
          <div className="w-50p text-right">{props[4]}</div>
        </div>
        {/* <div className="">{props[5]}</div> */}
        {/* <div className="">{props[6]}</div> */}
      </div>
    </>
  )
}

export default CardTask