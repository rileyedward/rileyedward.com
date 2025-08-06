import type { Project } from '@/types/components/portfolio/project-showcase';

export const projects: Project[] = [
    {
        id: 'applicy',
        title: 'Applicy',
        shortDescription: 'Streamline your job application journey.',
        fullDescription:
            'Applicy is a comprehensive online platform that simplifies your job application process. Create a personalized profile to seamlessly track all your job applications and monitor their progress in real time. With Applicy, you can easily organize your job search efforts, making it simpler to stay on top of your applications and secure your next opportunity.',
        type: 'web-app',
        technologies: [
            { name: 'Vue.js', category: 'frontend' },
            { name: 'TypeScript', category: 'frontend' },
            { name: 'Tailwind CSS', category: 'frontend' },
            { name: 'Laravel', category: 'backend' },
            { name: 'PHP', category: 'backend' },
            { name: 'PostgreSQL', category: 'database' },
        ],
        features: [
            'Keep track of the different job applications you have submitted as well as the status of each of them.',
            "Upload and store your resumes and have the AI assistant for recommendations on your Resume based on the job you're applying for.",
            "Upload and store your cover letters to have the AI assistant make different versions for the various jobs you're applying for.",
        ],
        links: [
            { type: 'github', url: 'https://github.com/rileyedward/applicy', label: 'View Code' },
            { type: 'blog', url: '/blog/streamlining-the-job-hunt-process', label: 'Blog Post' },
        ],
    },

    {
        id: 'corvesive',
        title: 'Corvesive',
        shortDescription: 'Simplify your budgeting.',
        fullDescription:
            'Corvesive is an online application designed to simplify your budgeting. Track your income by uploading pay stubs, record your monthly expenses, and effortlessly monitor where your money is going and how much you have left. Gain clarity on your financial situation to make better budgeting decisions.',
        type: 'web-app',
        technologies: [
            { name: 'Vue.js', category: 'frontend' },
            { name: 'TypeScript', category: 'frontend' },
            { name: 'Tailwind CSS', category: 'frontend' },
            { name: 'Laravel', category: 'backend' },
            { name: 'PHP', category: 'backend' },
            { name: 'MySQL', category: 'database' },
        ],
        features: [
            'Upload paystubs and keep a record of all your incoming income sources.',
            'Record monthly expenses and categrorize them for easy tracking.',
            'Visualize where your month is going to make informed budgeting decisions.',
        ],
        links: [
            { type: 'github', url: 'https://github.com/rileyedward/corvesive', label: 'View Code' },
            { type: 'blog', url: '/blog/the-finance-app-with-infinite-iterations', label: 'Blog Post' },
        ],
    },

    {
        id: 'airqueue',
        title: 'AirQueue',
        shortDescription: 'Share music with your friends using Live Sessions!',
        fullDescription:
            "AirQueue is a platform designed to enhance your music-sharing experience with friends through interactive Live Sessions. Integrating seemlessly with the Spotify Developer API to search for songs, as well as interact with the user's Spotify account.",
        type: 'web-app',
        technologies: [
            { name: 'Vue.js', category: 'frontend' },
            { name: 'TypeScript', category: 'frontend' },
            { name: 'Tailwind CSS', category: 'frontend' },
            { name: 'Laravel', category: 'backend' },
            { name: 'PHP', category: 'backend' },
            { name: 'MySQL', category: 'database' },
        ],
        features: [
            'Connect your AirQueue account with Spotify to properly use the application.',
            'Join a "band" with other members to aggregate a large group of like-minded music friends.',
            'Host or join a session with your friends to begin searching and requesting songs for them to listen to.',
        ],
        links: [
            { type: 'github', url: 'https://github.com/rileyedward/airqueue', label: 'View Code' },
            { type: 'blog', url: '/blog/building-without-expectations', label: 'Blog Post' },
        ],
    },

    {
        id: 'gip',
        title: 'gip',
        shortDescription: 'CLI tool for work-in-progress commits.',
        fullDescription:
            'gip is a lightweight command-line tool designed to streamline work-in-progress (WIP) commits for developers. If you often find yourself juggling micro-commits during development, gip helps you manage them efficiently without complicating your Git workflow.',
        type: 'cli-tool',
        technologies: [
            { name: 'Go', category: 'backend' },
            { name: 'Git', category: 'backend' },
        ],
        features: [
            'Quickly make a commit for all the work you currently have in-progress.',
            'Rebase all recent "WIP Commits" into a single commit with a provided message.',
        ],
        links: [
            { type: 'github', url: 'https://github.com/rileyedward/gip', label: 'View Code' },
            { type: 'blog', url: '/blog/solving-micro-commits-with-wip-commits', label: 'Blog Post' },
        ],
    },

    {
        id: 'rbranch',
        title: 'rbranch',
        shortDescription: 'CLI tool built to simplify Git branches.',
        fullDescription:
            'rbranch is a CLI tool built with Go and Bubble Tea designed to simplify your Git workflow. If you’re tired of typing long and cumbersome branch names, rbranch can help. With just a few commands and flags, you can effortlessly perform common Git branch operations and streamline your development process.',
        type: 'cli-tool',
        technologies: [
            { name: 'Go', category: 'backend' },
            { name: 'Bubbletea', category: 'backend' },
            { name: 'Git', category: 'backend' },
        ],
        features: [
            'Easily switch to another branch without typing its full name.',
            'Safely cleanup unused local branches.',
            'Save time ny instantly copying an entire branch name to your clipboard.',
        ],
        links: [
            { type: 'github', url: 'https://github.com/rileyedward/rbranch', label: 'View Code' },
            { type: 'blog', url: '/blog/simplifying-git-branch-management', label: 'Blog Post' },
        ],
    },
];

export const getProjectsByType = (type: Project['type']): Project[] => {
    return projects.filter((project) => project.type === type);
};

export const getTypeIcon = (type: Project['type']): string => {
    switch (type) {
        case 'web-app':
            return '🌐';
        case 'mobile-app':
            return '📱';
        case 'cli-tool':
            return '⚡';
        case 'library':
            return '📚';
        case 'api':
            return '🔌';
        default:
            return '💻';
    }
};
