import type { Load } from '@sveltejs/kit';

interface IProject {
	title: string;
	description: string;
	overview: string;
	development: string;
	github_url?: string;
	images: string[];
}

export const load: Load = async () => {
	const projects: IProject[] = [
		{
			title: 'Applicy',
			description:
				'Applicy is a comprehensive online platform that simplifies your job application process. Create a personalized profile to seamlessly track all your job applications and monitor their progress in real time. With Applicy, you can easily organize your job search efforts, making it simpler to stay on top of your applications and secure your next opportunity.',
			overview:
				'After signing up for an account with Applicy, you can build out your profile by adding details about your professional and educational experience, as well as showcasing your portfolio projects. This comprehensive information provides our AI assistant with the essential context needed to support and enhance your job search.\nApplicy also allows you to upload your resume and cover letter, serving as a centralized repository for all your job-hunting resources. The AI assistant can then provide personalized advice on how to improve these documents, boosting your chances of landing a job.\nAdditionally, Applicy enables you to track your ongoing applications, including details such as location, salary range, employer contact information, and the current status of each application. Using the AI assistant, you can generate tailored cover letters for specific applications and receive guidance on how to optimize your resume for each position.',
			development:
				'Applicy is a full-stack application powered by Laravel, seamlessly integrating Inertia.js and Vue.js for a dynamic and responsive frontend. Styled with TailwindCSS and backed by a MySQL database, it leverages the Laravel Breeze starter kit to provide ready-made components and comprehensive authentication.\nTo enhance the developer experience, Applicy utilizes Laravel Sail for streamlined creation and management of Docker container environments.\nApplicy also integrates the OpenAI API to offer AI-generated assistance for managing active applications, resumes, and cover letters, with Laravel Saloon employed to efficiently handle API interactions.',
			github_url: 'https://github.com/rileyedward/applicy.git',
			images: ['/applicy/applicy-1.png', '/applicy/applicy-2.png', '/applicy/applicy-3.png']
		},
		{
			title: 'Corvesive',
			description:
				'Corvesive is an online application designed to simplify your budgeting. Track your income by uploading pay stubs, record your monthly expenses, and effortlessly monitor where your money is going and how much you have left. Gain clarity on your financial situation to make better budgeting decisions.',
			overview:
				'Once you register an account with Corvesive, you can enhance your financial profile by creating Paystubs to provide insights into your monthly income. For each Paystub, you’ll need to specify the issuer, the amount, and the recurrence rate throughout the month. This information will schedule an instance of the Paystub for the next 12 months, giving you clear visibility into your income and its timing.\nIn addition to managing your income, Corvesive allows you to track your monthly expenses. You can categorize these into bills for one-time payments like rent, budgets for variable costs such as groceries, and savings for money set aside for future goals. This helps you maintain a clear overview of your spending and saving habits.\nThroughout the month, you can report your transactions to gain real-time insights into your available balance and monitor all upcoming expenses. This feature ensures you stay informed about your financial status at any given time, helping you manage your budget effectively.',
			development:
				'Corvesive is a full-stack application powered by Laravel, seamlessly integrating Inertia.js and Vue.js for a dynamic and responsive frontend. Styled with TailwindCSS and backed by a MySQL database, it leverages the Laravel Breeze starter kit to provide ready-made components and comprehensive authentication.\nTo enhance the developer experience, Corvesive utilizes Laravel Sail for streamlined creation and management of Docker container environments.\nCorvesive leverages the event-driven design pattern, a hallmark of the Laravel ecosystem, to efficiently manage and coordinate multiple asynchronous tasks. This approach enhances the application’s ability to handle complex workflows with greater flexibility and responsiveness.',
			github_url: 'https://github.com/rileyedward/corvesive.git',
			images: [
				'/corvesive/corvesive-1.png',
				'/corvesive/corvesive-2.png',
				'/corvesive/corvesive-3.png'
			]
		},
		{
			title: 'AirQueue',
			description:
				"AirQueue is a platform designed to enhance your music-sharing experience with friends through interactive Live Sessions. Integrating seemlessly with the Spotify Developer API to search for songs, as well as interact with the user's Spotify account.",
			overview:
				'After registering for an account with AirQueue, you’ll need to link it with your Spotify account. This connection provides the necessary authorization to access and interact with your Spotify data, enhancing your overall experience. You can also connect with other AirQueue users and join them in a band, making it easier to share live sessions and enjoy music together.\nIn AirQueue, you have the option to join an existing Live Session or create your own. This feature allows users to collaborate by making song requests, which are displayed in a live feed. You can participate in multiple Live Sessions, allowing you to filter and manage incoming song requests by session, as well as view all requests on your main dashboard.\nFor each song request, you can choose to either approve or deny it. Denying a request simply removes it from your personal list, while approving it adds the song to your current live Spotify player’s queue, placing it next in your listening experience. This ensures that the most desired tracks are played in your live session.',
			development:
				'AirQueue is a full-stack application powered by Laravel, seamlessly integrating Inertia.js and Vue.js for a dynamic and responsive frontend. Styled with TailwindCSS and backed by a MySQL database, it leverages the Laravel Breeze starter kit to provide ready-made components and comprehensive authentication.\nTo enhance the developer experience, AirQueue utilizes Laravel Sail for streamlined creation and management of Docker container environments.\nAdditionally, AirQueue connects to the Spotify Web API, allowing users to link their accounts, search for songs, and add tracks to their active player queue, enhancing the overall user experience.',
			github_url: 'https://github.com/rileyedward/airqueue.git',
			images: ['/airqueue/airqueue-1.png', '/airqueue/airqueue-2.png', '/airqueue/airqueue-3.png']
		},
		{
			title: 'rbranch',
			description:
				'rbranch is a CLI tool built with Go and Bubble Tea designed to simplify your Git workflow. If you’re tired of typing long and cumbersome branch names, rbranch can help. With just a few commands and flags, you can effortlessly perform common Git branch operations and streamline your development process.',
			overview:
				'Once rbranch is set up, you can use its commands to streamline your Git workflow. With the `rbranch` command, you can easily checkout branches from your Git repository, which provides a list of available branches for seamless switching.\nYou can also copy a branch name to your clipboard using the `rbranch -c` command, making it simple to share branch names or use them in other contexts.\nFor branch management, rbranch offers the `rbranch -d` command to delete a branch. This command lets you select the branch from a list, helping you keep your branch inventory organized and up-to-date.',
			development:
				'rbranch is a straightforward CLI tool that leverages built-in packages from the Go ecosystem, such as `flag` and `os/exec`, to deliver reliable functionality and user-friendly operation. Additionally, it employs the bubbletea and lipgloss packages for handling more advanced CLI terminal user interface implementations and styling, enhancing its overall usability and appearance.\nAs a straightforward tool, all of the code resides in the `main.go` file. However, it is designed with flexibility in mind, making it easy to modify styling and configuration, as well as to add additional flags or commands as needed.',
			github_url: 'https://github.com/rileyedward/rbranch.git',
			images: ['/rbranch/rbranch-1.png']
		}
	];

	return {
		projects: projects as IProject[]
	};
};
