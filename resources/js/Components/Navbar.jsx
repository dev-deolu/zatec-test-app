import React, { useRef, useEffect, useState } from "react";
import { Link, useForm } from '@inertiajs/react';
import LogoutIcon from '@/Components/LogoutIcon';
import { SidebarItems } from '@/Components/SideBarItems';
import MobileNavIcon from '@/Components/MobileNavIcon';
import SearchIcon from '@/Components/SearchIcon';
import ProfileIcon from '@/Components/ProfileIcon';
import useOutsideClick from "@/Hooks/useOutsideClick";
import TextInput from "./TextInput";

const Navbar = ({ user }) => {
    const { data, setData, post, processing, errors, reset } = useForm({
        search: '',
    });
    const [isExpanded, setIsExpanded] = useState(false);
    const toggleSidebar = () => { setIsExpanded(!isExpanded); };
    const closeSidebar = () => { setIsExpanded(false); };
    const ref = useOutsideClick(closeSidebar);
    const handleOnChange = (event) => {
        setData(event.target.name, event.target.value);
        // make api call for search here
    };
    return (
        <div ref={ref} className="flex w-full items-center justify-between bg-transparent py-6 px-6">
            <div className="relative">
                <TextInput id="search" type="text" name="search" value={data.search} onChange={handleOnChange} placeholder="Search" />
                <SearchIcon className="svg-icon search-icon w-4 h-4 absolute top-1/3 right-3" />
            </div>

            <div className="flex items-center rounded-3xl bg-black/80 p-1">
                <Link href='/profile'> <span className="mx-2  font-semibold text-white" >{user?.name ?? <ProfileIcon />}</span></Link>
            </div>
            <div className="md:hidden">
                <MobileNavIcon onClick={toggleSidebar} />
            </div>
            <div className={`sidebar md:hidden ${isExpanded ? "block" : "hidden"}`}>
                <div className="flex  h-full flex-col justify-between pl-6">
                    <ul className="mt-6 py-8">
                        {SidebarItems.map((item, i) => (
                            <li key={item.name} className="mb-6">
                                <Link
                                    href={item.link}
                                    className={({ isActive }) =>
                                        isActive ? "text-white" : "text-[#b3b3b3]"
                                    }
                                >
                                    <div className="flex items-center ">
                                        <item.icon className="mr-4 h-7 w-7" />
                                        <span className="text-lg">{item.name}</span>
                                    </div>
                                </Link>
                            </li>
                        ))}
                    </ul>

                    <div>
                        <Link href={route('logout')} method="post" as="button">
                            <div className="flex cursor-pointer items-center">
                                <LogoutIcon className="mr-4 h-7 w-7" />
                                <span className="text-lg">Logout</span>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Navbar;
