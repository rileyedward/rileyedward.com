import { AboutWidget } from '@/types/components/about/about-widget';
import { BookIcon, BoxesIcon, DiscIcon, GamepadIcon, HeadphonesIcon, KeyboardIcon } from 'lucide-vue-next';

export const aboutWidgets: AboutWidget[] = [
    {
        icon: BoxesIcon,
        title: "Rubik's Cube Record",
        message: '30 seconds',
    },
    {
        icon: KeyboardIcon,
        title: 'WPM Record',
        message: '165 WPM',
    },
    {
        icon: DiscIcon,
        title: 'Favorite Hobby',
        message: 'Disc Golf',
    },
    {
        icon: GamepadIcon,
        title: 'Currently Playing',
        message: 'Hitman World of Assassins',
    },
    {
        icon: HeadphonesIcon,
        title: 'On Repeat',
        message: 'Big Thief - Shark Smile',
    },
    {
        icon: BookIcon,
        title: 'Recent Favorite',
        message: 'Tomorrow, and Tomorrow, and Tomorrow',
    },
];
