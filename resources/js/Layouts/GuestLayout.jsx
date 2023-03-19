import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function Guest({ children }) {
    return (
        <div className="bg-white h-[100vh]  px-4 py-8">
            <div className="w-full sm:w-10/12 md:w-9/12 lg:w-7/12 xl:w-1/2 mx-auto">
                <div>
                    <Link href="/">
                        <ApplicationLogo className="mx-auto w-20 h-20" />
                    </Link>
                </div>
                {children}
            </div>
        </div>
    );
}
