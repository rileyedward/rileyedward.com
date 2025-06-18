import { BlogPost } from '@/types/models/blog-post';
import { Category } from '@/types/models/category';

export interface BlogShowPageProps {
    blogPost: BlogPost & {
        published_at: string;
        author?: string;
        category?: string;
    };
}

export interface BlogIndexPageProps {
    blogPosts?: BlogPost[] | null;
    categories?: Category[] | null;
}
