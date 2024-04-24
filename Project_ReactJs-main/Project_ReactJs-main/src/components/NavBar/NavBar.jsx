import React, { useState, useEffect } from 'react';
import SearchResults from '../SearchResults/SearchResults';
import Notification from './notificationAwal';
import { useDetectClickOutside } from 'react-detect-click-outside';

export default function NavBar() {
  const [search, setSearch] = useState('');
  const [showSearch, setShowSearch] = useState(false);
  const [showWelcomeNotification, setShowWelcomeNotification] = useState(true);
  const ref = useDetectClickOutside({ onTriggered: toggleSearchOff });

  useEffect(() => {
    // Menampilkan notifikasi selamat datang setelah halaman dimuat
    setTimeout(() => {
      setShowWelcomeNotification(false);
    }, 60000); // Menampilkan selama 3 detik
  }, []);

  function handleSetSearch(event) {
    setSearch(event.target.value);
  }

  function toggleSearchOn() {
    setShowSearch(true);
  }

  function toggleSearchOff() {
    setShowSearch(false);
  }

  return (
    <div className="relative">
      
      <div
        className="p-4 drop-shadow-xl flex bg-neutral-800 sticky top-0 z-40 w-screen"
        style={{ position: 'fixed', width: '100%' }}
      >
        <div className="flex items-center gap-1.5 cursor-pointer">
          <h1 className="font-bold font-serif" style={{ fontSize: '24px' }}>
            Movie
          </h1>
        </div>
        <form className="relative flex w-1/2 ml-10 mr-5" ref={ref}>
          <input
            type="text"
            id="simple-search"
            className="bg-neutral-800 border border-neutral-700 text-neutral-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 w-full"
            placeholder="Search..."
            value={search}
            onChange={handleSetSearch}
            onMouseDown={toggleSearchOn}
          />
          {showSearch && <SearchResults search={search} />}
        </form>
        {showWelcomeNotification && (
        <Notification
          message="Nama : Fadhli Shabri Irawan, Kelas : XI RPL 1"
          handleClose={() => setShowWelcomeNotification(false)}
        />
      )}
      </div>
    </div>
  );
}
