import React from "react";
import PlusIcon from "@/Components/PlusIcon";
import AuthenticatedLayout from "@/Layouts/AuthLayout";
import { Head, Link } from "@inertiajs/react";

const ArtistDetails = (props) => {
    const data = {
        id: props?.artist?.mbid ? props?.artist?.mbid : props?.artist?.name,
        imageUrl: props?.artist?.image[1]['#text'] ? props?.artist?.image[1]['#text'] : "",
        name: props?.artist?.name ?? '',
        bio: props?.artist?.bio?.content ? props?.artist?.bio?.content : "NO CONTENT"
    };
    const isFavorite = (artist) => {
        return props?.favorites.some((favorite) => favorite.name.toLowerCase() == artist.toLowerCase() || favorite.mbid == artist.toLowerCase())
    }

    return (
        <AuthenticatedLayout
            auth={props.auth}
            search='artist'
            errors={props.errors}
        >
            <Head title={props?.artist?.name ?? 'Artist Details'} />

            <div className="">
                <div className="flex h-[20rem] items-end bg-gradient-to-b from-[#4F4F4F] to-black/5 p-8">
                    <div className="flex items-center">
                        <div className=" mr-6 ">
                            <img src={data.imageUrl} alt="avatar" className="h-48 w-48" />
                        </div>
                        <div>
                            <h6>Artist</h6>
                            <h3 className="text-xl font-extrabold md:text-2xl xl:text-6xl">
                                {data.name}
                            </h3>
                        </div>
                    </div>
                </div>
                <div className="">
                    {isFavorite(data.id) ? <Link
                        href={route('artist.destroy', { "artist": data.id })}
                        method="delete"
                        as="button"
                        className=" " >
                        <div className="ml-4 flex items-center bg-black px-5 py-2 rounded-xl w-fit">
                            <span>Remove Favourites</span>
                        </div>

                    </Link> : <Link
                        href={route('artist.store', { "artist": data.id })}
                        method="post"
                        as="button"
                        className=" " >
                        <div className="ml-4 flex items-center bg-black px-5 py-2 rounded-xl w-fit">
                            <PlusIcon className="w-5 h-5 mr-2" />
                            <span>Add to Favourites</span>
                        </div>
                    </Link>}
                    <div className="mb-6 p-4">
                        <h5 className="text-2xl font-semibold ">Bio of {data.name}</h5>
                        <div className="flex items-center justify-between border-b-[0.5px] border-b-[#4F4F4F] py-3 px-2">
                            <div>{data?.bio}</div>
                        </div>
                    </div>

                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default ArtistDetails;
