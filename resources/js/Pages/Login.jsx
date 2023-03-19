import { useEffect } from 'react';
import { Link, Head, useForm } from '@inertiajs/react';
import GoogleIcon from '@/Components/GoogleIcon';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';

export default function Login(props) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const handleOnChange = (event) => {
        setData(event.target.name, event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    return (
        <GuestLayout>
            <Head title="Login" />
            <div className="my-5 mx-auto max-w-[480px]">
                <h5 className="text-center text-lg font-semibold  lg:text-2xl">Login</h5>

                <div className="my-4">
                    <button className="flex w-full items-center justify-center rounded-[40px] border-[3px] border-dark py-3 font-medium text-dark">
                        <GoogleIcon className="mr-3" />
                        <span className="">Continue with Google</span>
                    </button>
                </div>

                <h4 className="my-6 text-center font-semibold ">Or</h4>

                <form onSubmit={submit}>
                    <div className="mb-5">
                        <InputLabel htmlFor="email" value="Email address" />
                        <TextInput id="email" type="email" name="email" value={data.email} placeholder="Enter your email address" autoComplete={"false"} onChange={handleOnChange} required />
                        <InputError message={errors.email} className="mt-2" />
                    </div>

                    <div className="mb-5">
                        <InputLabel htmlFor="password" value="Password" />
                        <TextInput id="password" type="password" name="password" value={data.password} placeholder="Password" autoComplete="new-password" onChange={handleOnChange} required />
                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    <div className="border-b-2 border-b-grey py-6 text-center">
                        <button className="rounded-3xl bg-dark  py-3 px-10 font-medium text-white hover:scale-110" >
                            Login
                        </button>
                    </div>

                    <div className="py-5">
                        <h3 className="mb-4">Don't have an account?</h3>
                        <Link href={route('signup')}>
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
