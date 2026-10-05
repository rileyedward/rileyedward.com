export type ProjectKind = 'client' | 'personal';

export type ProjectStatus = 'live' | 'in_progress' | 'archived';

export type Project = {
    id: number;
    title: string;
    slug: string;
    kind: ProjectKind;
    kindLabel: string;
    summary: string;
    role: string | null;
    stack: string[];
    status: ProjectStatus;
    statusLabel: string;
    liveUrl: string | null;
    repoUrl: string | null;
    coverImageUrl: string | null;
    isVisible: boolean;
    isFeatured: boolean;
    bodyHtml?: string;
};

export type ProjectLink = {
    title: string;
    slug: string;
};

export type SiteSettings = {
    availability: string | null;
    contactEmail: string | null;
    githubUrl: string | null;
    linkedinUrl: string | null;
    yearsOfExperience: number | null;
};
