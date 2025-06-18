import { BlogPost } from '@/types/models/blog-post';

export interface BlogShowPageProps {
    blogPost: BlogPost & {
        published_at: string;
        author?: string;
        category?: string;
    };
}

export interface BlogIndexPageProps {
    blogPosts?: BlogPost[];
}
