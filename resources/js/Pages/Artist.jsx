import ArtistCard from '@/Components/ArtistCard';
import AuthenticatedLayout from '@/Layouts/AuthLayout';
import { Head } from '@inertiajs/react';

export default function Artist(props) {
    const artists = props?.artists;
    const favorites = props.favorites ?? [];
    const isFavorite = (artist) => {
        return favorites.some((favorite) => favorite.artist.name.toLowerCase() == artist.toLowerCase());
    }
    return (
        <AuthenticatedLayout
            auth={props.auth}
            search='artist'
            errors={props.errors}
        >
            <Head title="Artist" />
            <div className="p-4">
                <div className="mb-6">
                    <h4 className="font-bold text-lg md:text-xl xl:text-3xl">Artists</h4>
                </div>
                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3  xl:grid-cols-5">
                    {artists.map((artist) => (
                        <ArtistCard
                            key={artist.mbid ? artist.mbid : artist.name}
                            name={artist.name}
                            imageUrl={artist.image[1]['#text']}
                            id={artist.mbid ? artist.mbid : artist.name}
                            favorite={isFavorite(artist.name)}
                        />
                    ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
