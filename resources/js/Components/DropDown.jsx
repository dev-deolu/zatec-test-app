import React, { useState } from "react";
import useOutsideClick from "@/Hooks/useOutsideClick";

const Dropdown = ({ children, icon, width, full }) => {
    const [open, setOpen] = useState(false);
    const toggleOpen = (e) => {
        setOpen(!open);
    };

    const closeDropdown = () => {
        setOpen(false);
    };
    const ref = useOutsideClick(closeDropdown);
    return (
        <div ref={ref} className="relative ">
            <div
                className={`"cursor-pointer p-2 ${full ? "w-full" : "w-fit mx-auto"}`}
                onClick={toggleOpen}
            >
                {icon}
            </div>
            {open && (
                <div
                    className={`bg-[#1C1C1C] mt-3  text-[#b3b3b3] text-sm text-start py-3 px-4 z-[50] absolute -right-3  top-[50%]  rounded-md min-w-[8rem] shadow-custom2  ${width ? "width" : "w-fit"
                        }  cursor-pointer `}
                >
                    <div >{children}</div>
                </div>
            )}
        </div>
    );
};

export default Dropdown;
