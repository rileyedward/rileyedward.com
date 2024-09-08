import { z } from 'zod';

export const contactSchema = z.object({
	name: z
		.string()
		.min(2, { message: 'Name must be at least 2 characters long.' })
		.max(50, { message: 'Name must not exceed 50 characters.' }),
	email: z.string().email({ message: 'Please enter a valid email address.' }),
	message: z
		.string()
		.min(10, { message: 'Message must be at least 10 characters long.' })
		.max(500, { message: 'Message must not exceed 500 characters.' })
});
