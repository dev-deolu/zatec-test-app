import React, { useRef, useEffect, useState } from "react";
import { Link } from '@inertiajs/react';
// import { signIn, signUp, userProfile } from "../../config/app-urls";
// import CaretDown from "../../assets/icons/caret-down.svg";
// import CaretUp from "../../assets/icons/caret-up.svg";
// import UserIcon from "../../assets/icons/user-icon.svg";
import SearchIcon from '@/Components/SearchIcon';

const Navbar = ({user}) => {
    return (
        <div className="flex w-full items-center justify-between bg-transparent py-6 px-8">
            <div className="relative">
                <input
                    className="rounded-3xl bg-white py-2 px-4 text-dark placeholder:text-sm focus:outline-none lg:w-[18rem]"
                    placeholder="Search"
                />
                <SearchIcon className="svg-icon search-icon w-4 h-4 absolute top-1/3 right-3" />
            </div>

            <div className="flex items-center rounded-3xl bg-black/80 p-1">
                <Link href='/profile'> <span className="mx-2  font-semibold text-white" >{user?.name ?? 'Rukayat'}</span></Link>
            </div>
        </div>
    );
};

export default Navbar;
