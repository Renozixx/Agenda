import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'

const Aside = ({ onToggle }) => {
  const [isExpanded, setIsExpanded] = useState(false);
  const [timer, setTimer] = useState(null);

  // Toggles between expanded and collapsed
  const toggleAside = () => {
    setIsExpanded((prevState) => !prevState);
    resetTimer(); // Reset the timer when user interacts
    onToggle(isExpanded); // Chamando onToggle com o estado atual
  };

  // Auto-shrink the aside after 30 seconds
  const autoShrink = () => {
    setIsExpanded(false);
  };

  // Reset and set a new timer for 30 seconds
  const resetTimer = () => {
    if (timer) {
      clearTimeout(timer); // Clear the existing timer
    }
    setTimer(setTimeout(autoShrink, 30000)); // Set new timer for 30 seconds
  };

  // Initialize and cleanup the timer
  useEffect(() => {
    resetTimer(); // Start the timer on component mount

    return () => {
      clearTimeout(timer); // Clean up the timer on unmount
    };
  }, []); // Empty dependency array so it only runs on mount/unmount

  return (
    
    <aside
      className={`fixed left-0 top-0 h-screen bg-gray-800 text-white transition-all duration-300 ${
        isExpanded ? 'w-64' : 'w-16'
      }`}
    >
      {/* Toggle Button */}
      <button
        onClick={toggleAside}
        className="w-full p-4 bg-gray-700 hover:bg-gray-600 focus:outline-none"
      >
        {isExpanded ? 'x' : '>'}
      </button>
      <div className='flex w-full justify-center items-center'>
        <img src="/user_default.png" alt="Teste" className={`transition-all duration-100 items-center justify-center ${isExpanded ? 'w-1/3' : 'w-full' }`} />
      </div>
      {/* Content only visible when expanded */}
      {isExpanded && (
        <div className="mt-4 space-y-4 p-4">
          <ul className="space-y-2">                
            <li className="p-2 bg-gray-600 rounded hover:bg-gray-500"><Link to={"/"}>Home</Link></li>
            <li className="p-2 bg-gray-600 rounded hover:bg-gray-500"><Link to={"/login"}>Login</Link></li>
            <li className="p-2 bg-gray-600 rounded hover:bg-gray-500"><Link to={"/register"}>Registrar-se</Link></li>
          </ul>
        </div>
      )}
    </aside>
  );
};

export default Aside