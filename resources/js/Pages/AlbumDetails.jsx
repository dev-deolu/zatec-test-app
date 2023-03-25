import React from "react";
import PlusIcon from "@/Components/PlusIcon";
import AuthenticatedLayout from "@/Layouts/AuthLayout";
import { Head, Link } from "@inertiajs/react";

const AlbumDetails = (props) => {
    const data = {
        coverUrl: props?.album?.image[1]['#text'] ? props?.album?.image[1]['#text'] : "",
        title: props?.album?.name ?? '',
        artistName: props?.album?.artist ?? '',
        tracklist: props?.album?.tracks?.track ?? [],
        id: props?.album?.name + '|' + props?.album?.artist,
    };
    const isFavorite = (album, artist) => {
        return props.favorites.some((favorite) => favorite.name.toLowerCase() == album.toLowerCase() && favorite.artist.toLowerCase() == artist.toLowerCase())
    }
    return (
        <AuthenticatedLayout
            auth={props.auth}
            search='album'
            errors={props.errors}
        >
            <Head title={props?.album?.name ?? 'ALbum Details'} />
            <div className="">
                <div className="flex h-[16rem] md:h-[20rem] items-end bg-gradient-to-b from-[#4F4F4F] to-black/5 p-8">
                    <div className="flex items-center">
                        <div className=" mr-6 ">
                            <img src={data.coverUrl} alt="avatar" className="md:h-48 md:w-48" />
                        </div>
                        <div>
                            <h6>Album</h6>
                            <h3 className="text-xl font-extrabold md:text-2xl xl:text-6xl">
                                {data.title}
                            </h3>
                            <div className="my-3 flex items-center">
                                <img
                                    src={data.coverUrl}
                                    alt=""
                                    className="mr-3 h-6 w-6 rounded-full"
                                />
                                <span className="mx-2 text-2xl font-bold">~</span>
                                <span>{data.artistName}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="">
                    {isFavorite(data.title, data.artistName) ? <Link
                        href={route('album.destroy', { "id": data.id })}
                        method="delete"
                        as="button"
                        className=" " >
                        <div className="ml-4 flex items-center bg-black px-5 py-2 rounded-xl w-fit">

                            <span>Remove Favourites</span>
                        </div>
                    </Link> : <Link
                        href={route('album.store', { "id": data.id })}
                        method="post"
                        as="button"
                        className=" " >
                        <div className="ml-4 flex items-center bg-black px-5 py-2 rounded-xl w-fit">
                            <PlusIcon className="w-5 h-5 mr-2" />
                            <span>Add to Favourites</span>
                        </div>
                    </Link>}


                    <div className="p-4">
                        <div className="flex items-center justify-between border-b-[0.5px] border-b-[#4F4F4F] py-4 px-2">
                            <div>
                                <span className="mr-3">#</span>
                                <span className="">Tracks</span>
                            </div>
                        </div>

                        {data.tracklist && data.tracklist.length > 0 ? (
                            data.tracklist?.map((track, i) => (
                                <div key={track.title} className="mb-3 flex items-center  justify-between py-4 px-2" >
                                    <div>
                                        <span className="mr-3">{i + 1}</span>
                                        <span className="">{track.name}</span>
                                    </div>
                                </div>
                            ))) : (
                            <div className="mt-12 h-25 flex items-center justify-center text-white ">
                                <p>No Tracks available </p>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default AlbumDetails;
