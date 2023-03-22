import { Link, Head, useForm } from '@inertiajs/react';
import ThreeDotIcon from './ThreeDotIcon';
import Dropdown from './DropDown';

export default function AlbumCard(albumData) {
    const { coverUrl, title, artistName, id, favorite } = albumData;
    return (
        <>
            <div className="relative rounded-xl bg-transparent/40 p-5 hover:bg-[#1C1C19]">
                <Link href={route('album.show', { album: id })}>
                    <div>
                        <img src={coverUrl} alt="albumcover" className="w-full" />
                    </div>
                    <div className="font-regular my-4 text-sm">
                        <h5 className="my-1 truncate text-lg font-semibold">{title}</h5>
                        <span className="">{artistName}</span>
                    </div>
                </Link>
                <div className="absolute bottom-2 right-2">
                    <div className="">
                        <Dropdown icon={<ThreeDotIcon className="w-5" />}>
                            <ul className="p-2">
                                {favorite ? <Link
                                    href={route('album.destroy', { "id": id })}
                                    method="delete"
                                    as="button"
                                    className=" whitespace-nowrap" >
                                    Remove Favourites
                                </Link> : <Link
                                    href={route('album.store', { "id": id })}
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
