import { useState } from 'react';
import Navbar from '@/Components/Navbar';
import Sidebar from '@/Components/Sidebar';
import { Link } from '@inertiajs/react';

export default function AuthenticatedLayout({ auth,children }) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);
    return (
        <div className="bg-dark text-[#b3b3b3] relative">
        <div className="hidden md:block fixed left-0 top-0 bottom-0 w-[16rem]">
          <Sidebar />
        </div>
        <div className="flex flex-col justify-between ml-[16rem] min-h-screen">
          <div>
            <Navbar user={auth.user} />
            <div className="px-8">{children}</div>
          </div>
          {/* <Footer /> */}
        </div>
      </div>
    );
}
