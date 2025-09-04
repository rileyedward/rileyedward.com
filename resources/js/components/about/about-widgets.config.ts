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
        message: '187 WPM',
        href: 'https://monkeytype.com/profile/rileyedward',
    },
    {
        icon: DollarSignIcon,
        title: 'Current Hobby',
        message: 'Poker',
        href: null,
    },
    {
        icon: HeadphonesIcon,
        title: 'On Repeat',
        message: 'The Beatles - Abbey Road',
        href: 'https://music.apple.com/us/album/abbey-road-remastered/1441164426',
    },
    {
        icon: GamepadIcon,
        title: 'Currently Playing',
        message: "no Man's Sky",
        href: 'https://www.nomanssky.com/',
    },
    {
        icon: BookIcon,
        title: 'Recent Favorite',
        message: 'Tomorrow, and Tomorrow, and Tomorrow',
        href: 'https://www.amazon.com/Tomorrow-novel-Gabrielle-Zevin/dp/0593321200',
    },
];
