import type { TechStackCategory, TechStackItem } from '@/types/components/portfolio/tech-stack';

export const techStackConfig: TechStackCategory[] = [
    {
        name: 'Frontend',
        description: 'Building beautiful, responsive user interfaces',
        color: 'purple',
        items: [
            {
                name: 'Vue.js',
                category: 'Frontend',
                level: 'Expert',
                years: 4,
            },
            {
                name: 'Svelte Kit',
                category: 'Frontend',
                level: 'Intermediate',
                years: 2,
            },
            {
                name: 'TypeScript',
                category: 'Frontend',
                level: 'Advanced',
                years: 3,
            },
            {
                name: 'JavaScript',
                category: 'Frontend',
                level: 'Expert',
                years: 5,
            },
            {
                name: 'Tailwind CSS',
                category: 'Frontend',
                level: 'Expert',
                years: 4,
            },
        ],
    },
    {
        name: 'Backend',
        description: 'Server-side development and API design',
        color: 'blue',
        items: [
            {
                name: 'Laravel',
                category: 'Backend',
                level: 'Expert',
                years: 4,
            },
            {
                name: 'PHP',
                category: 'Backend',
                level: 'Expert',
                years: 4,
            },
            {
                name: 'Node.js',
                category: 'Backend',
                level: 'Advanced',
                years: 3,
            },
            {
                name: 'RESTful APIs',
                category: 'Backend',
                level: 'Expert',
                years: 5,
            },
        ],
    },
    {
        name: 'Database',
        description: 'Data storage and management solutions',
        color: 'green',
        items: [
            {
                name: 'PostgreSQL',
                category: 'Database',
                level: 'Advanced',
                years: 4,
            },
            {
                name: 'MySQL',
                category: 'Database',
                level: 'Advanced',
                years: 5,
            },
            {
                name: 'Redis',
                category: 'Database',
                level: 'Intermediate',
                years: 2,
            },
        ],
    },
    {
        name: 'Cloud & DevOps',
        description: 'Infrastructure, deployment, and cloud services',
        color: 'cyan',
        items: [
            {
                name: 'AWS',
                category: 'Cloud & DevOps',
                level: 'Intermediate',
                years: 2,
            },
            {
                name: 'Digital Ocean',
                category: 'Cloud & DevOps',
                level: 'Intermediate',
                years: 2,
            },
            {
                name: 'Docker',
                category: 'Cloud & DevOps',
                level: 'Advanced',
                years: 4,
            },
            {
                name: 'Git',
                category: 'Cloud & DevOps',
                level: 'Expert',
                years: 5,
            },
        ],
    },
    {
        name: 'Tools & Others',
        description: 'Development tools and additional technologies',
        color: 'orange',
        items: [
            {
                name: 'Figma',
                category: 'Tools & Others',
                level: 'Intermediate',
                years: 3,
            },
            {
                name: 'Visual Studio Code',
                category: 'Tools & Others',
                level: 'Expert',
                years: 5,
            },
            {
                name: 'JetBrains IDEs',
                category: 'Tools & Others',
                level: 'Advanced',
                years: 4,
            },
        ],
    },
];

export const getLevelColor = (level: TechStackItem['level']): string => {
    switch (level) {
        case 'Expert':
            return 'bg-green-500';
        case 'Advanced':
            return 'bg-blue-500';
        case 'Intermediate':
            return 'bg-yellow-500';
        case 'Beginner':
            return 'bg-gray-500';
        default:
            return 'bg-gray-500';
    }
};

export const getCategoryColor = (color: string): string => {
    switch (color) {
        case 'purple':
            return 'border-purple-500';
        case 'blue':
            return 'border-blue-500';
        case 'green':
            return 'border-green-500';
        case 'cyan':
            return 'border-cyan-500';
        case 'orange':
            return 'border-orange-500';
        default:
            return 'border-gray-500';
    }
};
