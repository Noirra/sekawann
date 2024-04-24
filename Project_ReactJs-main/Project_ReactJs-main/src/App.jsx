import React, { useEffect } from 'react';
import NavBar from "./components/NavBar/NavBar";
import SideBar from "./components/SideBar/SideBar";
import Content from "./components/Content/Content";
import MovieModal from "./components/MovieModal/MovieModal";
import {useDispatch, useSelector} from "react-redux";
import {hide, isEnabled, loadRating} from "./redux/reducers/movieModalSlice";
import {useDetectClickOutside} from "react-detect-click-outside";
import { configureStore } from '@reduxjs/toolkit';



function App() {

    const movieModalEnabled = useSelector(isEnabled);
    const dispatch = useDispatch();
    useEffect(() => {
        dispatch(loadRating());
      }, [dispatch]);


    return (
        <div>
            <div className="flex flex-col">
                <NavBar/>
                <div className="flex h-fit">
                    <SideBar/>
                    <Content/>
                </div>
            </div>
            {movieModalEnabled &&
                <div
                    className="fixed top-0 left-0 bg-black w-full h-full flex items-center justify-center bg-opacity-50 z-50"
                    onClick={(event) => event.currentTarget === event.target && dispatch(hide())}
                >
                    <MovieModal />
                </div>
            }
        </div>
  );
}

export default App;
