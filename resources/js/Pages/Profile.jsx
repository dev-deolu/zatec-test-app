import AuthenticatedLayout from '@/Layouts/AuthLayout';
import { Link, Head } from '@inertiajs/react';
import AlbumCard from '@/Components/AlbumCard';
import ArtistCard from '@/Components/ArtistCard';

export default function Profile(props) {
    const albums = props?.albums;
    const artists = props?.artists;
    const isFavoriteAlbum = (album, artist) => {
        return albums.some(({ album: favorite }) => favorite.name.toLowerCase() == album.toLowerCase() && favorite.artist.toLowerCase() == artist.toLowerCase());
    }
    const isFavoriteArtist = (artist) => {
        return artists.some(({ artist: favorite }) => favorite.name.toLowerCase() == artist.toLowerCase() || favorite.mbid == artist.toLowerCase());
    }
    return (
        <AuthenticatedLayout auth={props.auth} errors={props.errors} >
            <Head title={props.auth.user.name ?? "Profile"} />
            <div className="">
                <div className="flex h-[20rem] items-end bg-gradient-to-b from-[#4F4F4F] to-black/5 p-8">
                    <div className="flex items-center">
                        <div className=" mr-6 rounded-full bg-black/40 shadow-custom1">
                            <img src={`https://lh3.googleusercontent.com/a/AGNmyxaKDoWfLBekd22tgDzHWbmmZVjObpxvBBnlWoLd=s96-c`} alt="avatar" className="rounded-full w-16 h-16 md:h-28  md:w-28" />
                        </div>
                        <div>
                            <h3 className="text-xl font-extrabold md:text-2xl xl:text-6xl">
                                {props.auth.user.name}
                            </h3>
                        </div>
                    </div>
                </div>

                <div className="mb-4 py-6">
                    <div className="mb-6 flex items-center justify-between">
                        <h4 className="text-lg font-bold md:text-xl xl:text-3xl">
                            Favourite Albums
                        </h4>
                        {albums?.length > 2 ? (
                            <Link href={'/album'}>
                                <span className="font-semibold ">Show all</span>
                            </Link>
                        ) : null}
                    </div>
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">

                        {albums && albums.length > 0 ? (
                            albums.slice(0, 5).map(({ album }) => (
                                <AlbumCard
                                    key={album.name + '|' + album.artist}
                                    id={album.name + '|' + album.artist}
                                    title={album.name}
                                    coverUrl={album.image[1]['#text']}
                                    artistName={album.artist}
                                    favorite={isFavoriteAlbum(album.name, album.artist)}
                                />
                            ))
                        ) : (
                            <div className=" h-25 flex items-center justify-center text-white ">
                                <p>No  Favourite Album </p>
                            </div>
                        )}
                    </div>
                </div>
                <div className="py-6">
                    <div className="mb-6 flex items-center justify-between">
                        <h4 className="text-lg font-bold md:text-xl xl:text-3xl">
                            Favourite Artists
                        </h4>
                        {artists?.length > 2 ? (
                            <Link href={'/artist'}>
                                <span className="font-semibold ">Show all</span>
                            </Link>
                        ) : null}
                    </div>
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">

                        {artists && artists.length > 0 ? (
                            artists.slice(0, 5).map(({ artist }) => (
                                <ArtistCard
                                    key={artist.mbid ? artist.mbid : artist.name}
                                    name={artist.name}
                                    imageUrl={artist.image[1]['#text']}
                                    id={artist.mbid ? artist.mbid : artist.name}
                                    favorite={isFavoriteArtist(artist.name)}
                                />
                            ))
                        ) : (
                            <div className="h-25 flex items-center justify-center text-white ">
                                <p>No Favourite Artist  </p>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
