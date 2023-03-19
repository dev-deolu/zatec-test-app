import { Link } from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo';
// import { albums, artists, userProfile } from "../../config/app-urls";
import AlbumIcon from '@/Components/AlbumIcon';
import LogoutIcon from '@/Components/LogoutIcon';

const Sidebar = () => {
    const sidebaritems = [
        { name: "Albums", link: '/albums', icon: AlbumIcon },
        { name: "Artists", link: '/artists', icon: AlbumIcon },
        { name: "Profile", link: '/profile', icon: AlbumIcon },
    ];
    return (
        <div className=" flex  h-full min-h-screen  flex-col justify-between bg-black p-8 text-[#b3b3b3]">
            <div>
                <div className="">
                    <ApplicationLogo fill="white" />
                </div>

                <ul className="mt-6 py-8">
                    {sidebaritems.map((item, i) => (
                        <li key={item.name} className="mb-6">
                            <Link
                                href={item.link}
                                className={({ isActive }) =>
                                    isActive ? "text-white" : "text-[#b3b3b3]"
                                }
                            >
                                <div className="flex items-center ">
                                    <item.icon className="mr-4 h-7 w-7" />
                                    {/* <img src={item.icon} alt="icon" className="mr-4 h-7 w-7" /> */}
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
