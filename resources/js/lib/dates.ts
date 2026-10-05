const dateTime = new Intl.DateTimeFormat(undefined, {
    dateStyle: 'medium',
    timeStyle: 'short',
});

export function formatDateTime(iso: string | null): string {
    return iso ? dateTime.format(new Date(iso)) : '';
}
