import { Link, Head } from '@inertiajs/react';
import GoogleIcon from '@/Components/GoogleIcon';
import GuestLayout from '@/Layouts/GuestLayout';

export default function Welcome(props) {
    return (
        <GuestLayout>
            <Head title="Welcome" />
            <div className="my-5 mx-auto max-w-[480px]">
                <h5 className="text-center text-lg font-semibold  lg:text-2xl">Login</h5>

                <div className="my-4">
                    <button className="flex w-full items-center justify-center rounded-[40px] border-[3px] border-dark py-3 font-medium text-dark">
                        <GoogleIcon className="mr-3" />
                        <span className="">Continue with Google</span>
                    </button>
                </div>

                <h4 className="my-6 text-center font-semibold ">Or</h4>

                <form>
                    <div className="mb-5">
                        <label className="mb-3">Email address </label>
                        <input className="input" placeholder="Email address" />
                    </div>

                    <div className="mb-5">
                        <label className="mb-3">Password</label>
                        <input className="input" placeholder="Password" />
                    </div>

                    <div className="border-b-2 border-b-grey py-6 text-center">
                        <button
                            className="rounded-3xl bg-dark  py-3 px-10 font-medium text-white hover:scale-110"
                            onClick={(e) => onSubmit(e)}
                        >
                            Login
                        </button>
                    </div>

                    <div className="py-5">
                        <h3 className="mb-4">Don't have an account?</h3>
                        <Link to={'/'}>
                            <button className="w-full rounded-[40px] border-[3px] border-grey py-3 font-medium text-dark">
                                Sign Up
                            </button>
                        </Link>
                    </div>
                </form>
            </div>
        </GuestLayout>
    );
}
