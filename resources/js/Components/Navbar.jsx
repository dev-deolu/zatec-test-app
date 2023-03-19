import React, { useRef, useEffect, useState } from "react";
import { Link } from '@inertiajs/react';
// import { signIn, signUp, userProfile } from "../../config/app-urls";
// import CaretDown from "../../assets/icons/caret-down.svg";
// import CaretUp from "../../assets/icons/caret-up.svg";
// import UserIcon from "../../assets/icons/user-icon.svg";
import SearchIcon from '@/Components/SearchIcon';

const Navbar = () => {
    return (
        <div className="flex w-full items-center justify-between bg-transparent py-6 px-8">
            <div className="relative">
                <input
                    className="rounded-3xl bg-white py-2 px-4 text-dark placeholder:text-sm focus:outline-none lg:w-[18rem]"
                    placeholder="Search"
                />
                <SearchIcon class="svg-icon search-icon w-4 h-4 absolute top-1/3 right-3" />
            </div>

            {/* <div className=''>
                        <Link to={signUp} className="mr-6">
                        <button className='text-[#b3b3b3] font-medium '>Sign up</button></Link>
                        <Link to={signIn}>
                        <button className='bg-[#F6F6F6] text-black py-3 px-8 rounded-3xl'>Login</button></Link>
                    </div> */}

            <div className="flex items-center rounded-3xl bg-black/80 p-1">
                {/* <div className="h-8 w-8 rounded-full bg-[#525252] p-1">
                    <img src={UserIcon} alt="user" className="w-full" />
                    </div> */}
                <Link href='/profile'> <span className="mx-2  font-semibold text-white" >Ruqayat</span></Link>
                {/* <img src={CaretDown} alt="caret" className=" mr-2 h-5 w-5" /> */}
            </div>
        </div>
    );
};

export default Navbar;
