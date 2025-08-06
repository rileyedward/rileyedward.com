export interface ProjectLink {
    type: 'github' | 'live' | 'demo' | 'blog';
    url: string;
    label: string;
}

export interface ProjectTechnology {
    name: string;
    category: 'frontend' | 'backend' | 'database' | 'tools' | 'cloud';
}

export interface Project {
    id: string;
    title: string;
    shortDescription: string;
    fullDescription: string;
    type: 'web-app' | 'mobile-app' | 'cli-tool' | 'library' | 'api';
    technologies: ProjectTechnology[];
    features: string[];
    links: ProjectLink[];
    images?: string[];
}

export interface ProjectCategory {
    name: string;
    description: string;
    projects: Project[];
}
