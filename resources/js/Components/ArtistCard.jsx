import { Link, Head, useForm } from '@inertiajs/react';

export default function ArtistCard(artistData) {
    const { imageUrl = "", name = "", id } = artistData;
    return (
        <>
            <Link href={`/artist/${id}`}>
                <div className="rounded-xl bg-transparent/40 p-5 hover:bg-[#1C1C19]">
                    <div className="rounded-full p-4">
                        <img src={imageUrl} alt="artist" className="w-full rounded-full" />
                    </div>
                    <div className="my-4 text-sm">
                        <h6 className="text-lg font-semibold">{name}</h6>
                        <span className="">Artist</span>
                    </div>
                </div>
            </Link>
        </>
    );
};
