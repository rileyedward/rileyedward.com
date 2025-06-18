import { Category } from './category';

export interface BlogPost {
    id: number;
    category_id: number;
    title: string;
    slug: string;
    content: string;
    is_published: string;
    created_at: string;
    updated_at: string;
    deleted_at?: string | null;
    // Relationships
    category?: Category;
    // Additional fields that might be added in the frontend
    published_at?: string;
    author?: string;
}

export interface BlogPostRequest {
    category_id: number;
    title: string;
    content: string;
    is_published: string;
}
