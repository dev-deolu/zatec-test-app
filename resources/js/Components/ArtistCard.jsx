import { Link, Head, useForm } from '@inertiajs/react';
import ThreeDotIcon from './ThreeDotIcon';
import Dropdown from './DropDown';

export default function ArtistCard(artistData) {
    const { imageUrl = "", name = "", id, favorite } = artistData;
    return (
        <>
            <div className="relative rounded-xl bg-transparent/40 p-5 hover:bg-[#1C1C19]">
                <Link href={`/artist/${id}`}>

                    <div className="rounded-full p-4">
                        <img src={imageUrl} alt="artist" className="w-full rounded-full" />
                    </div>
                    <div className="my-4 text-sm">
                        <h6 className="text-lg font-semibold">{name}</h6>
                        <span className="">Artist</span>
                    </div>

                </Link>
                <div className="absolute bottom-2 right-2">
                    <div className="">
                        <Dropdown icon={<ThreeDotIcon className="w-5" />}>
                            <ul className="p-2">
                            {favorite ? <Link
                                    href={route('artist.destroy', { "artist": id })}
                                    method="delete"
                                    as="button"
                                    className=" whitespace-nowrap" >
                                    Remove Favourites
                                </Link> : <Link
                                    href={route('artist.store', { "artist": id })}
                                    method="post"
                                    as="button"
                                    className=" whitespace-nowrap" >
                                    Add to Favourites
                                </Link>}
                            </ul>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </>
    );
};
