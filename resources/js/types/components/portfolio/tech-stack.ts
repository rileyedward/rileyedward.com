export interface TechStackItem {
    name: string;
    category: string;
    level: 'Beginner' | 'Intermediate' | 'Advanced' | 'Expert';
    years?: number;
}

export interface TechStackCategory {
    name: string;
    items: TechStackItem[];
    color: string;
    description: string;
}
