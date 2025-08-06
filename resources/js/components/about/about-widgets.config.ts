import { AboutWidget } from '@/types/components/about/about-widget';
import { BookIcon, BoxesIcon, DollarSignIcon, GamepadIcon, HeadphonesIcon, KeyboardIcon } from 'lucide-vue-next';

export const aboutWidgets: AboutWidget[] = [
    {
        icon: BoxesIcon,
        title: "Rubik's Cube Record",
        message: '33 seconds',
        href: '',
    },
    {
        icon: KeyboardIcon,
        title: 'Fastest WPM',
        message: '164',
        href: 'https://monkeytype.com/profile/rileyedward',
    },
    {
        icon: DollarSignIcon,
        title: 'Favorite Hobby',
        message: 'Poker',
        href: null,
    },
    {
        icon: HeadphonesIcon,
        title: 'On Repeat',
        message: 'Big Thief - Shark Smile',
        href: 'https://open.spotify.com/album/6I4gdKmXKdh6SP1yRlrQGD',
    },
    {
        icon: GamepadIcon,
        title: 'Currently Playing',
        message: 'Elden Ring Nightreign',
        href: 'https://store.steampowered.com/app/2622380/ELDEN_RING_NIGHTREIGN/',
    },
    {
        icon: BookIcon,
        title: 'Recent Favorite',
        message: 'Tomorrow, and Tomorrow, and Tomorrow',
        href: 'https://www.amazon.com/Tomorrow-novel-Gabrielle-Zevin/dp/0593321200',
    },
];
