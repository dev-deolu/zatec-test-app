import { useEffect } from 'react';
import GoogleIcon from '@/Components/GoogleIcon';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import { Link, Head, useForm } from '@inertiajs/react';

export default function SignUp(props) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const handleOnChange = (event) => {
        setData(event.target.name, event.target.value);
    };
    const submit = (e) => {
        e.preventDefault();
        post('signup');
    };

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    return (
        <GuestLayout>
            <Head title="SignUp" />
            <div className="my-5 max-w-[480px] mx-auto">
                <h5 className="text-lg lg:text-2xl text-center  font-semibold">
                    Sign Up
                </h5>

                <div className="my-4">
                    <button className="flex items-center justify-center w-full py-3 border-[3px] border-dark rounded-[40px] text-dark">
                        <GoogleIcon className="mr-3" />
                        <span className="">Sign Up with Google</span>
                    </button>
                </div>

                <h4 className="text-center font-semibold  my-6">Or</h4>

                <form onSubmit={submit}>
                    <div className="mb-5">
                        <InputLabel htmlFor="name" value="What's your name?" />
                        <TextInput id="name" type="text" name="name" value={data.name} placeholder="Enter your full name" autoComplete="name" onChange={handleOnChange} required />
                        <InputError message={errors.name} className="mt-2" />
                    </div>

                    <div className="mb-5">
                        <InputLabel htmlFor="email" value="What's your email address?" />
                        <TextInput id="email" type="email" name="email" value={data.email} placeholder="Enter your email address" autoComplete={"false"} onChange={handleOnChange} required />
                        <InputError message={errors.email} className="mt-2" />
                    </div>

                    <div className="mb-5">
                        <InputLabel htmlFor="password" value="Create a password" />
                        <TextInput id="password" type="password" name="password" value={data.password} placeholder="Create a password" autoComplete="new-password" onChange={handleOnChange} required />
                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    <div className="mb-5">
                        <InputLabel htmlFor="password_confirmation" value="Confirm your password" />
                        <TextInput id="password_confirmation" type="password" name="password_confirmation" value={data.password_confirmation} placeholder="Confirm your password" autoComplete="new-password" onChange={handleOnChange} required />
                        <InputError message={errors.password_confirmation} className="mt-2" />
                    </div>

                    <div className="text-center">
                        <button disabled={processing} className="rounded-3xl bg-dark py-3 px-10 font-medium text-white hover:scale-110 mb-4">
                            Create Account
                        </button>

                        <p className="font-medium">Have an account? <Link className="text-theme underline font-normal" href={route('welcome')} >Log In</Link></p>
                    </div>
                </form>
            </div>
        </GuestLayout>
    );
}
