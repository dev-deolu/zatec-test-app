import AlbumCard from '@/Components/AlbumCard';
import AuthenticatedLayout from '@/Layouts/AuthLayout';
import { Head } from '@inertiajs/react';

export default function Album(props) {
    const albums = props?.albums;
    const favorites = props.favorites ?? [];
    const isFavorite = (album, artist) => {
        return favorites.some((favorite) => favorite.name.toLowerCase() == album.toLowerCase() && favorite.artist.toLowerCase() == artist.toLowerCase());
    }
    return (
        <AuthenticatedLayout
            auth={props.auth}
            search='album'
            errors={props.errors}
        >
            <Head title="Artist" />

            <div className="p-4">
                <div className="mb-6">
                    <h4 className="text-lg font-bold md:text-xl xl:text-3xl">Albums</h4>
                </div>
                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3  xl:grid-cols-5">
                    {albums && albums.map((album) => (
                        <AlbumCard
                            key={album.name + '|' + album.artist}
                            id={album.name + '|' + album.artist}
                            title={album.name}
                            coverUrl={album.image[1]['#text']}
                            artistName={album.artist}
                            favorite={isFavorite(album.name, album.artist)}
                        />
                    ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
