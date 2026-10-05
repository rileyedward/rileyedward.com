export type InboxMessageSummary = {
    id: number;
    name: string;
    email: string;
    businessName: string | null;
    excerpt: string;
    isRead: boolean;
    receivedAt: string | null;
};

export type InboxMessage = {
    id: number;
    name: string;
    email: string;
    businessName: string | null;
    phone: string | null;
    message: string;
    ipAddress: string | null;
    userAgent: string | null;
    receivedAt: string | null;
    isArchived: boolean;
};

export type Paginated<T> = {
    data: T[];
    current_page: number;
    last_page: number;
    total: number;
    prev_page_url: string | null;
    next_page_url: string | null;
};

export type Option = {
    value: string;
    label: string;
};
