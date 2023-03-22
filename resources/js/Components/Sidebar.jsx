import { Link } from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo';
// import { albums, artists, userProfile } from "../../config/app-urls";
import { SidebarItems } from '@/Components/SideBarItems';
import LogoutIcon from '@/Components/LogoutIcon';

const Sidebar = () => {
    return (
        <div className="flex h-full min-h-screen flex-col justify-between bg-black p-8 text-[#b3b3b3]">
            <div>
                <div className="">
                    <ApplicationLogo fill="white" className="w-24 h-24" />
                </div>

                <ul className="mt-6 py-8">
                    {SidebarItems.map((item, i) => (
                        <li key={item.name} className="mb-6">
                            <Link href={item.link} >
                                <div className="flex items-center ">
                                    <item.icon className="mr-4 h-7 w-7" />
                                    <span className="text-lg">{item.name}</span>
                                </div>
                            </Link>
                        </li>
                    ))}
                </ul>
            </div>

            <div>
                <Link href={route('logout')} method="post" as="button">
                    <div className="flex items-center cursor-pointer">
                        <LogoutIcon className="mr-4 h-7 w-7" />
                        <span className="text-lg ml-4"> Logout</span>
                    </div>
                </Link>

            </div>
        </div>
    );
};

export default Sidebar;
