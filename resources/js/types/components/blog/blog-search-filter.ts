import { Category } from '@/types/models/category';

export interface Props {
    categories: Category[];
}

export interface Emits {
    (e: 'update:searchQuery', query: string): void;
    (e: 'update:selectedCategory', categoryId: number | null): void;
}
