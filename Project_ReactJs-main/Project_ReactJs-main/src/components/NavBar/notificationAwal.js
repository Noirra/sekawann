import React, { useEffect } from 'react';
import { FaTimes } from 'react-icons/fa'; // Import the close icon

function Notification({ message, handleClose }) {
  useEffect(() => {
    const timer = setTimeout(() => {
      handleClose(); // Tutup notifikasi setelah beberapa waktu
    }, 10000); // Ubah sesuai kebutuhan Anda (dalam milidetik)

    return () => {
      clearTimeout(timer);
    };
  }, [handleClose]);

  const notificationStyle = {
    backgroundColor: '#333',
    color: '#fff',
    padding: '10px',
    borderRadius: '5px',
    boxShadow: '0px 0px 10px rgba(0, 0, 0, 0.2)',
    display: 'flex',
    justifyContent: 'space-between',
    alignItems: 'center',
  };

  const closeButtonStyle = {
    backgroundColor: 'transparent',
    border: 'none',
    color: '#fff',
    cursor: 'pointer',
    opacity: '0.7',
    margin: '0 5px',
    transition: 'opacity 0.3s', // Add a transition for a smooth effect
  };

  return (
    <div style={notificationStyle}>
      <p>{message}</p>
      <button style={closeButtonStyle} onClick={handleClose} title="Close">
        <FaTimes />
      </button>
    </div>
  );
}

export default Notification;
