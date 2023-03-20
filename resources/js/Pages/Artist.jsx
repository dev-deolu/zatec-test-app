import AuthenticatedLayout from '@/Layouts/AuthLayout';
import { Head } from '@inertiajs/react';

export default function Artist(props) {
    return (
        <AuthenticatedLayout
            auth={props.auth}
            search='artist'
            errors={props.errors}
        >
            <Head title="Artist" />

        </AuthenticatedLayout>
    );
}
