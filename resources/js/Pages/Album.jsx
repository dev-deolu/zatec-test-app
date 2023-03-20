import AuthenticatedLayout from '@/Layouts/AuthLayout';
import { Head } from '@inertiajs/react';

export default function Album(props) {
    return (
        <AuthenticatedLayout
            auth={props.auth}
            search='album'
            errors={props.errors}
        >
            <Head title="Artist" />

        </AuthenticatedLayout>
    );
}
