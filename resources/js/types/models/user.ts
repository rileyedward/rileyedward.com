export interface User {
    id: number;
    username: string;
    password: string;
    remember_token: string | null;
    created_at: string;
    updated_at: string;
}
