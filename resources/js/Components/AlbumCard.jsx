import { Link, Head, useForm } from '@inertiajs/react';
// type AlbumDataProps = {
//   coverUrl: string;
//   title: string;
//   releaseDate: string;
//   artistName: string;
//   id: string;
//   // tracklist: [];
// };

export default function AlbumCard(albumData) {
    const { coverUrl, title, releaseDate, artistName, id } = albumData;
    return (
        <>
            <Link href={`/album/${id}`}>
                <div className="rounded-xl bg-transparent/40 p-5 hover:bg-[#1C1C19]">
                    <div>
                        <img src={coverUrl} alt="albumcover" className="w-full" />
                    </div>
                    <div className="font-regular my-4 text-sm">
                        <h5 className="my-4 truncate text-lg font-semibold">{title}</h5>
                        <span className="">{releaseDate}</span> <span>.</span>{" "}
                        <span className="">{artistName}</span>
                    </div>
                </div>
            </Link>
        </>
    );
};
