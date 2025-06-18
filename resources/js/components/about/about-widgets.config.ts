import { AboutWidget } from '@/types/components/about/about-widget';
import { BookIcon, BoxesIcon, DiscIcon, GamepadIcon, HeadphonesIcon, KeyboardIcon } from 'lucide-vue-next';

export const aboutWidgets: AboutWidget[] = [
    {
        icon: BoxesIcon,
        title: "Rubik's Cube Record",
        message: '33 seconds',
    },
    {
        icon: KeyboardIcon,
        title: 'Fastest WPM',
        message: '164',
    },
    {
        icon: DiscIcon,
        title: 'Favorite Hobby',
        message: 'Disc Golf',
    },
    {
        icon: HeadphonesIcon,
        title: 'On Repeat',
        message: 'Big Thief - Shark Smile',
    },
    {
        icon: GamepadIcon,
        title: 'Currently Playing',
        message: 'Hitman World of Assassins',
    },
    {
        icon: BookIcon,
        title: 'Recent Favorite',
        message: 'Tomorrow, and Tomorrow, and Tomorrow',
    },
];
