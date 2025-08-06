import { LucideIcon } from 'lucide-vue-next';

export interface AboutWidget {
    icon: LucideIcon;
    title: string;
    message: string;
    href?: string | null;
}

export interface Props {
    icon: LucideIcon;
    title: string;
    message: string;
    href?: string;
}
