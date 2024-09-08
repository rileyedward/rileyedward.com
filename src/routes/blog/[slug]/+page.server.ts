import type { Load } from '@sveltejs/kit';
import prisma from '$lib/server/db';
import type { blog_posts } from '@prisma/client';

export const load: Load = async ({ params }) => {
	const slug = params.slug as string;

	const blogPost: blog_posts | null = await prisma.blog_posts.findFirst({
		where: {
			slug: slug
		}
	});

	return {
		post: blogPost as blog_posts
	};
};
