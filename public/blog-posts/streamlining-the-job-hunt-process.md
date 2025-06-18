Job hunting can feel overwhelming, especially depending on where you are in your career. I vividly remember the early days of my development journey, when I was applying for summer internships. At one point, I had sent out over 90 applications. Keeping track of all the applications I’d submitted, the ones still in progress, the status of each, and all the details surrounding my job search felt nearly impossible. It quickly became clear that I needed a better way to stay organized and on top of it all.

When it came time to search for new job opportunities again, I applied the lessons I’d learned from my previous experiences by building a project to help manage the entire process. In doing so, I created "Applicy" — a tool designed to streamline job hunting and keep everything organized.

## What Does Applicy Do?

Once you register for an account with **Applicy**, you can create a detailed profile by adding information about your professional background, education, and portfolio projects. This comprehensive data provides the context our AI assistant needs to offer personalized support throughout your job search.

**Applicy** also serves as a centralized hub where you can upload and store your resume and cover letter. With these resources in one place, the AI assistant can offer tailored advice on how to refine your documents, increasing your chances of landing your ideal job.

In addition, **Applicy** allows you to easily track the status of your job applications, including key details such as location, salary expectations, employer contact information, and current progress. The AI assistant helps you generate customized cover letters for each application and provides tips on how to optimize your resume for specific roles.

## Working with AI... Kind of

While the recent surge of AI technologies has sparked my interest, my exposure has mostly been limited to tools like ChatGPT and GitHub Copilot to assist with coding. Beyond that, I haven’t ventured much into areas like image generation, AI-driven code editors, or diving deep into how large language models actually function. So, even though my project relies on making API calls to OpenAI’s most basic model, this marks my first real experience building something with AI at its core.

It was an enjoyable challenge to write the logic that parses user and job application data from the database, transforming it into a digestible format for the AI assistant (via the OpenAI API). This allowed the assistant to have the context it needed to make informed and relevant suggestions. While I’m sure there are improvements to be made in how I aggregate and organize user data, I chose to tackle the problem with the technical knowledge I had at the time. Looking back, I might have done more research before diving in, but for the simple use case at hand, I felt confident that my approach would work for now.

## Once Again, Laravel Saves the Day

As with many of my personal projects, I wouldn’t have been able to develop as quickly or efficiently without the power of Laravel. The framework has been a game changer for me, enabling rapid development and helping me focus on the core functionality rather than reinventing the wheel. I could easily spend hours discussing the numerous ways Laravel has streamlined my projects—something I’ve already done in several blog posts and even during a tech talk at a local developer meetup. But for now, I’ll keep it brief.

### Inertia.js

Building projects with Laravel and Inertia.js is often referred to as creating a “modern monolith,” and for good reason. Inertia allows you to harness the full power of Laravel and PHP on the server side while seamlessly integrating with frontend technologies like Vue.js (and TypeScript) on the client side. This approach provides the benefits of a single, unified stack without the need to manage complex API layers or build a traditional single-page application (SPA). The result is a smooth, efficient development experience that lets you focus on building features rather than managing the separation of concerns between backend and frontend. It’s a combination that feels like magic, offering the best of both worlds in a clean, straightforward package.

### Laravel Saloon

Laravel Saloon is a robust HTTP client package that simplifies making HTTP requests in Laravel, allowing for a clean and expressive interface when interacting with external APIs. For my project, I used Saloon to handle all communication with the OpenAI API. By organizing the API calls related to generating cover letters and offering resume suggestions within Saloon, I was able to keep my code well-structured and maintainable. Saloon’s built-in error handling and customization options, like retries and response management, saved me from writing complex logic to manage these requests manually. This allowed me to focus on the core features of Applicy while ensuring smooth and efficient interaction with the OpenAI API.

### File Storage

Laravel’s built-in file storage system makes it incredibly easy to manage file uploads and organize files within your application. For Applicy, I used Laravel’s file storage capabilities to handle the uploading and storing of resume PDF files and other documents related to job applications. The process is straightforward thanks to Laravel’s simple API, which allows me to store files locally or in cloud storage with minimal configuration. I organized the files by user and application, ensuring that each document is stored in an easily accessible location. The flexibility of Laravel’s file storage system also means that, should I decide to scale the project or switch to a cloud storage solution like Amazon S3, Google Cloud Storage, or any other service, it would be as simple as changing a few configuration settings. Laravel makes switching between different storage drivers seamless, offering an excellent way to future-proof the project with minimal effort.

## What's Next?

Although **Applicy** was once live and deployed through Digital Ocean and Laravel Forge, it is no longer operational at the moment. I originally built the project for personal use, with no intention of marketing or maintaining it long-term. As a result, I never set up the infrastructure for ongoing support or updates. However, despite its downtime, I’ve always felt that **Applicy** holds a lot of potential.

In the future, I may revisit this project, refine it further, and potentially make it available for public use. With the job hunting and interview landscape evolving rapidly, it would be exciting to see how **Applicy** could adapt and offer value in this changing environment.
