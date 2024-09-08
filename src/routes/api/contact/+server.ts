import { contactSchema } from '$lib/server/schemas/contact.schema.js';
import prisma from '$lib/server/db.js';

export const POST = async ({ request }) => {
	const data = await request.json();
	const schema = contactSchema.safeParse(data);

	if (!schema.success) {
		const errors = schema.error.errors.map((error) => error);

		return new Response(JSON.stringify(errors), { status: 422 });
	}

	await prisma.contact_messages.create({
		data: {
			name: schema.data.name,
			email: schema.data.email,
			message: schema.data.message
		}
	});

	return new Response('ok');
};
