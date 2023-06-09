import Navbar from '@/Components/Navbar';
import Sidebar from '@/Components/Sidebar';

export default function AuthenticatedLayout({ auth, children, search }) {
    return (
        <div className="bg-dark text-[#b3b3b3] relative">
            <div className="hidden md:block fixed left-0 top-0 bottom-0 w-[16rem]">
                <Sidebar />
            </div>
            <div className="flex flex-col justify-between md:ml-[16rem] min-h-screen pb-12">
                <div>
                    <Navbar user={auth.user} search={search}  />
                    <div className="px-8">{children}</div>
                </div>
                {/* <Footer /> */}
            </div>
        </div>
    );
}
