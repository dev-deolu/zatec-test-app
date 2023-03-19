import { useEffect } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function SignUp() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const handleOnChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('register'));
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <div className="my-5 max-w-[480px] mx-auto">
                <h5 className="text-lg lg:text-2xl text-center  font-semibold">
                    Sign Up
                </h5>

                <div className="my-4">
                    <button className="flex items-center justify-center w-full py-3 border-[3px] border-dark rounded-[40px] text-dark">
                        <img src={GoogleIcon} alt="" className="mr-3" />
                        <span className="">Sign Up with Google</span>
                    </button>
                </div>

                <h4 className="text-center font-semibold  my-6">Or</h4>

                <form>
                    <div className="mb-5">
                        <label className="mb-3">What's your name?</label>
                        <input
                            className="input"
                            placeholder="Enter your first name"
                        />
                    </div>
                    <div className="mb-5">
                        <label className="mb-3">What's your email address?</label>
                        <input
                            className="input"
                            placeholder="Enter your last name"
                        />
                    </div>
                    <div className="mb-5">
                        <label className="mb-3">Create a password</label>
                        <input
                            className="input"
                            placeholder="Create a password"
                        />
                    </div>
                    <div className="mb-8">
                        <label className="mb-3">Confirm your password</label>
                        <input
                            className="input"
                            placeholder="Confirm your password"
                        />
                    </div>

                    <div className="text-center">
                        <button className="bg-theme hover:scale-110  text-white font-medium py-3 px-10 rounded-3xl mb-4">
                            Create Account
                        </button>

                        <p className="font-medium">Have an account? <Link className="text-theme underline font-normal" to={signIn}>Log In</Link></p>
                    </div>
                </form>
            </div>
        </GuestLayout>
    );
}
