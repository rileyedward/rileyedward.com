export interface ContactMessage {
    id: number;
    name: string;
    business_name?: string;
    email: string;
    phone?: string;
    subject: string;
    message: string;
    created_at: string;
    updated_at: string;
}

export interface ContactMessageRequest {
    name: string;
    business_name?: string;
    email: string;
    phone?: string;
    subject: string;
    message: string;
}
