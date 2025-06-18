export interface TimelineItem {
    title: string;
    subtitle: string;
    description: string;
    align: 'left' | 'right';
}

export interface Props {
    timelineItems: TimelineItem[];
}
