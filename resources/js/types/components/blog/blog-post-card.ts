import { BlogPost } from '@/types/models/blog-post';

export interface Props {
    post: BlogPost & {
        published_at?: string;
        author?: string;
        category?: string;
    };
    categoryName?: string;
}
