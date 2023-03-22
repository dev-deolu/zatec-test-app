import React, { useRef, useEffect, useState } from "react";
import { Link, useForm } from '@inertiajs/react';
import LogoutIcon from '@/Components/LogoutIcon';
import { SidebarItems } from '@/Components/SideBarItems';
import MobileNavIcon from '@/Components/MobileNavIcon';
import SearchIcon from '@/Components/SearchIcon';
import ProfileIcon from '@/Components/ProfileIcon';
import useOutsideClick from "@/Hooks/useOutsideClick";
import InputError from "./InputError";


const Navbar = ({ user, search }) => {
    const { data, setData, get, processing, errors, reset } = useForm({
        search: '',
    });
    const [isExpanded, setIsExpanded] = useState(false);
    const toggleSidebar = () => { setIsExpanded(!isExpanded); };
    const closeSidebar = () => { setIsExpanded(false); };
    const ref = useOutsideClick(closeSidebar);
    const handleOnChange = (event) => {
        setData(event.target.name, event.target.value);
    };
    const submit = (e) => {
        e.preventDefault();
        if (data.search.length > 2) {
            get(route(search));
        }
    };
    return (
        <div ref={ref} className={`flex w-full items-center ${search? "justify-between" :"justify-end"}  bg-transparent py-6 px-6`}>

            {search ? (
                <div className="rounded-3xl bg-white py-2 px-4 text-dark lg:w-[24rem] xl:w-[28rem]">
                    <form onSubmit={submit} className='flex items-center'>
                        <input disabled={processing} placeholder="Search" className="mr-1 w-full placeholder:text-sm focus:outline-none" name="search" value={data.search} onChange={handleOnChange} />
                        <button className="shadow-custom1 hover:scale-110 rounded-full p-2" >
                            <SearchIcon className="svg-icon search-icon w-4 h-4" />
                        </button>
                    </form>
                    <InputError message={errors.type} className="mt-2" />
                </div>
            ) : null}

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
