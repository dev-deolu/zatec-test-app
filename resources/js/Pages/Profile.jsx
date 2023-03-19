import AuthenticatedLayout from '@/Layouts/AuthLayout';
import { Link, Head } from '@inertiajs/react';
import AlbumCard from '@/Components/AlbumCard';
import ArtistCard from '@/Components/ArtistCard';

export default function Profile(props) {
    const AlbumCover1 = '';
    const AlbumCover2 = '';
    const Artist1 = '';

    const albumsdata = [
        {
            coverUrl: AlbumCover1,
            title: "Dangerous Love",
            releaseDate: "2016",
            artistName: "BLACK PINK",
            tracklist: [
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
            ],
            id: "djhdcuj",
        },
        {
            coverUrl: AlbumCover2,
            title: "Dangerous Love (The EP)",
            releaseDate: "2018",
            artistName: "Cardi B",
            id: "dwujad",
        },
        {
            coverUrl: AlbumCover1,
            title: "Netflix and Chill",
            releaseDate: "2020",
            artistName: "Nicky Minaj",
            id: "davknie",
        },
        {
            coverUrl: AlbumCover2,
            title: "Netflix and Chill",
            releaseDate: "20120",
            artistName: "Nicky Minaj",
            id: "dchcdia",
        },
    ];
    const artistdata = [
        {
            id: "scgc",
            imageUrl: Artist1,
            name: "J.Cole",
            topTracks: [
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
                { title: "Happiness", duration: "2:10" },
            ],
            albums: [
                {
                    coverUrl: AlbumCover2,
                    title: "Dangerous Love (The EP)",
                    releaseDate: "2018",
                    artistName: "Cardi B",
                    id: "dwujad",
                },
                {
                    coverUrl: AlbumCover1,
                    title: "Netflix and Chill",
                    releaseDate: "2020",
                    artistName: "Nicky Minaj",
                    id: "davknie",
                },
                {
                    coverUrl: AlbumCover2,
                    title: "Netflix and Chill",
                    releaseDate: "20120",
                    artistName: "Nicky Minaj",
                    id: "dchcdia",
                },
                {
                    coverUrl: AlbumCover2,
                    title: "Netflix and Chill",
                    releaseDate: "20120",
                    artistName: "Nicky Minaj",
                    id: "dchcdia",
                },
                {
                    coverUrl: AlbumCover2,
                    title: "Netflix and Chill",
                    releaseDate: "20120",
                    artistName: "Nicky Minaj",
                    id: "dchcdia",
                },
                {
                    coverUrl: AlbumCover2,
                    title: "Netflix and Chill",
                    releaseDate: "20120",
                    artistName: "Nicky Minaj",
                    id: "dchcdia",
                },
                {
                    coverUrl: AlbumCover2,
                    title: "Netflix and Chill",
                    releaseDate: "20120",
                    artistName: "Nicky Minaj",
                    id: "dchcdia",
                },
            ],
        },
        // {
        //   imageUrl: Artist2,
        //   name: "Lizzo",
        // },
        // {
        //   imageUrl: Artist1,
        //   name: "Cardi B",
        // },
        // {
        //   imageUrl: Artist2,
        //   name: "Nicky Minaj",
        // },
        // {
        //   imageUrl: Artist1,
        //   name: "Cardi B",
        // },
        // {
        //   imageUrl: Artist2,
        //   name: "Nicky Minaj",
        // },
    ];

    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
        >
            <Head title="Profile" />
            <div className="">
                <div className="flex h-[20rem] items-end bg-gradient-to-b from-[#4F4F4F] to-black/5 p-8">
                    <div className="flex items-center">
                        <div className=" mr-6 rounded-full bg-black/40 shadow-custom1">
                            <img src={'https://lh3.googleusercontent.com/a/AGNmyxaKDoWfLBekd22tgDzHWbmmZVjObpxvBBnlWoLd=s96-c'} alt="avatar" className="rounded-full w-16 h-16 md:h-28  md:w-28" />
                        </div>
                        <div>
                            <h6>Profile</h6>
                            <h3 className="text-xl font-extrabold md:text-2xl xl:text-6xl">
                                Ruqayat
                            </h3>
                        </div>
                    </div>
                </div>
                <div className="mb-4 py-6">
                    <div className="mb-6 flex items-center justify-between">
                        <h4 className="text-lg font-bold md:text-xl xl:text-3xl">
                            Favourite Albums
                        </h4>
                        {albumsdata?.length > 2 ? (
                            <Link href={'/album'}>
                                <span className="font-semibold ">Show all</span>
                            </Link>
                        ) : null}
                    </div>
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                        {albumsdata.slice(0, 5).map((album) => (
                            <AlbumCard
                                key={album.title}
                                id={album.id}
                                title={album.title}
                                coverUrl={album.coverUrl}
                                releaseDate={album.releaseDate}
                                artistName={album.artistName}
                            />
                        ))}
                    </div>
                </div>
                <div className="py-6">
                    <div className="mb-6 flex items-center justify-between">
                        <h4 className="text-lg font-bold md:text-xl xl:text-3xl">
                            Favourite Artists
                        </h4>
                        {artistdata?.length > 2 ? (
                            <Link href={'/artist'}>
                                <span className="font-semibold ">Show all</span>
                            </Link>
                        ) : null}
                    </div>
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                        {artistdata.slice(0, 5).map((artist) => (
                            <ArtistCard
                                key={artist.name}
                                name={artist.name}
                                imageUrl={artist.imageUrl}
                                id={artist.id}
                            />
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
