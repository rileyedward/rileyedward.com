import { LucideIcon } from 'lucide-vue-next';

export interface AboutWidget {
    icon: LucideIcon;
    title: string;
    message: string;
}

export interface Props {
    icon: LucideIcon;
    title: string;
    message: string;
}
