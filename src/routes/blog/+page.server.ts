import type { Load } from '@sveltejs/kit';
import prisma from '$lib/server/db';
import type { blog_posts } from '@prisma/client';

export const load: Load = async () => {
	const blogPosts: blog_posts[] = await prisma.blog_posts.findMany({
		orderBy: {
			published_at: 'desc'
		}
	});

	return {
		posts: blogPosts as blog_posts[]
	};
};
