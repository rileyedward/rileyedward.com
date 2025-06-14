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
}

export interface BlogPostRequest {
    category_id: number;
    title: string;
    content: string;
    is_published: string;
}
